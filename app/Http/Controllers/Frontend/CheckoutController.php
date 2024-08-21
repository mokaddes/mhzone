<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\ShippingAddress;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use App\Models\User;
use App\Models\UserCard;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Modules\Ad\Entities\Ad;
use Srmklive\PayPal\Services\PayPal;
use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Token;

class CheckoutController extends Controller
{
    /**
     * @var string
     */
    private $trans_no;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $trans_no = 'tr_' . random_int(100, 999) . time();
        $this->trans_no = $trans_no;
    }

    public function index()
    {
        $cart = Session::get('cart');
        if (!isset($cart)) {
            return redirect()->route('frontend.index')->with('error', "Your cart is empty");
        }
        $id = Auth::user()->id;
        $card = UserCard::where('user_id', $id)->first();
        $address = ShippingAddress::where('user_id', $id)->get();
        return view('front.checkout', compact('card', 'address'));
    }

    public function getSavedAddress(Request $request)
    {
        $id = $request->id;
        $data = ShippingAddress::find($id);
        return response()->json($data);
    }

    public function orderPlace(Request $request)
    {
        $cart = Session::get('cart');
        if (!isset($cart)) {
            return redirect()->route('frontend.index')->with('error', 'Please add product to cart');
        }
        $data = $request->validate([
            'phone' => 'required',
            'apartment' => 'required|max:200',
            'address' => 'required|max:200',
            'city' => 'required|max:200',
            'address_type' => 'nullable',
            'state' => 'required|max:200',
            'postcode' => 'required',
            'total_price' => 'required',
            'shipping_charge' => 'nullable',
            'coupon_code' => 'nullable',
            'coupon_discount' => 'nullable',
            'subtotal' => 'nullable',
            'payment_method' => 'required',
        ], [
            'phone.required' => 'Phone field is required.',
            'apartment.required' => 'Apartment field is required.',
            'address.required' => 'Address field is required.',
            'city.required' => 'City field is required.',
            'state.required' => 'State field is required.',
            'postcode.required' => 'Postcode field is required.',
            'payment_method.required' => 'Select a payment method.',
//            'postcode.max' => 'Postcode not more than 5 digit.',
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['total_seller'] = cart_seller();
        $data['admin_commission_percent'] = setting('admin_commission');
        $last_id = Order::max('id') + 1;

        $orderNumber = Auth::id() . str_pad($last_id, 8, "0", STR_PAD_LEFT);
        $data['order_number'] = $orderNumber;

        if ($data['payment_method'] == 'stripe') {
            $response = $this->stripePayment($request, $orderNumber);
        }
        if ($data['payment_method'] == 'paypal') {
            $response = $this->paypalPayment($data, $orderNumber);
            return redirect()->away($response);
        }
        if (!isset($response)) {
            return redirect()->back()->with('error', 'payment is failed');
        }

        $this->create_order($data, $response);
        $this->sendOrderMail($data);

        Session::forget('cart');

        return redirect()->route('frontend.order.success', $orderNumber)->with('success', 'Order successfully placed');
    }

    public function create_order($data, $response)
    {
        $cart = Session::get('cart');
        $order_id = Order::insertGetId($data);

        foreach ($cart as $key => $value) {
            $ad = Ad::find($key);
            $item = new OrderDetail();
            $item->ad_id = $key;
            $item->order_id = $order_id;
            $item->seller_id = $ad->user_id;
            $item->buyer_id = Auth::user()->id;
            $item->price = $value['price'];
            $item->attributes = !empty($value['attr']) ? json_encode($value['attr'], true) : null;
            $item->quantity = $value['quantity'];
            $item->attrbite_price = $value['attr_price'];
            $item->total_price = $value['total_price'];
            $item->status = 'confirmed';
            $item->save();

            $ad->qty = $ad->qty - $value['quantity'];
            $ad->save();
        }

        $this->createTransactions($order_id, $response, $data['payment_method']);

    }

    public function orderComplete($id)
    {
        $order = Order::where('order_number', $id)->first();
        return view('front.order_complete', compact('order'));
    }


    public function stripePayment($request, $orderNumber)
    {
        try {
            Stripe::setApiKey(config('zakirsoft.stripe_secret'));

            $card = UserCard::where('user_id', Auth::user()->id)->first();

            $token = Token::create([
                'card' => [
                    'number' => $card->card_number,
                    'exp_month' => $card->exp_month,
                    'exp_year' => 25,
                    'cvc' => $card->cvc,
                ],
            ]);
            $price = $request->total_price * 100;

            $charge = Charge::create([
                "amount" => $price,
                "currency" => 'USD',
                "source" => $token['id'],
                "description" => "Payment for order " . $orderNumber . " in " . config('app.name'),
            ]);
            return $charge->id ?? $this->trans_no;

        } catch (\Exception $ex) {
            return null;
        }
    }

    public function paypalPayment($data, $orderNumber)
    {
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('frontend.paypal.success', [
                    'data' => $data,
                    'amount' => $data['total_price']
                ]),
                "cancel_url" => route('frontend.paypal.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => 'USD',
                        "value" => $data['total_price'],
                    ]
                ]
            ]
        ]);
        if (isset($response['id'])) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return $links['href'];
                }
            }

        } else {
            session()->flash('error', 'Something went wrong.');
            return null;
        }
    }

    public function successTransaction(Request $request)
    {
        $provider = new PayPal();
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $transaction_no = $response['id'] ?? $this->trans_no;

            $data = $request->get('data');
//            dd($data);

            $this->create_order($data, $transaction_no);
            $this->sendOrderMail($data);

            Session::forget('cart');

            return redirect()->route('frontend.order.success', $data['order_number'])->with('success', 'Order successfully placed');
        } else {
            session()->flash('error', 'Transaction is Invalid');
            return back();
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        session()->flash('error', 'Payment Failed');
        return back();
    }

    public function createTransactions($order_id, $transaction_number, $payment_provider)
    {
        $setting = Setting::first();
        $order = Order::find($order_id);
        $transaction = new Transaction();
        $transaction->transaction_number = $transaction_number;
        $transaction->order_id = $order_id;
        $transaction->user_id = Auth::user()->id;
        $transaction->amount = $order->total_price;
        $transaction->payment_provider = $payment_provider;
        $transaction->payment_status = 1;
        $transaction->created_at = now();
        $transaction->updated_at = now();
        $transaction->created_by = Auth::user()->id;
        $transaction->updated_by = Auth::user()->id;
        $transaction->save();

        $sellerOrder = $order->orderDetails()->get()->groupBy('seller_id');
        foreach ($sellerOrder as $sellerId => $orderDetail) {
            $totalPrice = $orderDetail->sum('total_price');
            $admin_commission = ($totalPrice * $setting->admin_commission)/100;
            $tr_details = new TransactionDetails();
            $tr_details->seller_id = $sellerId;
            $tr_details->shipping_charge = $setting->shipping_charge;
            $tr_details->order_id = $order_id;
            $tr_details->transaction_id = $transaction->id;
            $tr_details->amount = $totalPrice;
            $tr_details->admin_commission = $admin_commission;
            $tr_details->seller_total = $totalPrice + $setting->shipping_charge - $admin_commission;
            $tr_details->created_at = now();
            $tr_details->updated_at = now();
            $tr_details->created_by = Auth::user()->id;
            $tr_details->updated_by = Auth::user()->id;
            $tr_details->save();
        }
    }

    public function sendOrderMail($data)
    {
        $cart = Session::get('cart');
        $ids = array_keys($cart);
        $seller_ids = Ad::whereIn('id', $ids)->pluck('user_id')->toArray();
        $sellers = User::findMany($seller_ids);
        $shipping_address = $data['apartment'] . ' ' . $data['address'] . ', ' . $data['city'] . ', ' . $data['state'] . '-' . $data['postcode'];

        $details = [
            'subject' => 'Your order is successfully placed.',
            'greeting' => 'Hi '. Auth::user()->name,
            'body' => 'Thank you for placing your order with us. Here are the details of your order:',
            'order_no' => 'Order Number: ', $data['order_number'],
            'order_date' => 'Order Date: ' . date('d M, Y'),
            'shipping' => 'Shipping Address: ' . $shipping_address,
            'status' => 'Order Status: Confirmed',
            'action' => route('frontend.order.details', $data['order_number']),
            'thanks' => 'Thanks for being with ' . env('APP_NAME'),
        ];

        $admin = Admin::first();
        Notification::route('mail', Auth::user()->email)->notify(new OrderNotification($details));
        $details['subject'] = 'New order placed in ' . env('APP_NAME');
        $details['body'] = 'Congratulations! A new order placed. Here are the details:';
        $details['buyer'] = 'Order placed by: '. Auth::user()->name ;
        $details['greeting'] =  'Hi '. $admin->name;
        Notification::route('mail', $admin->email)->notify(new OrderNotification($details));

        $details['subject'] = 'New order received in ' . env('APP_NAME');
        $details['body'] = 'Congratulations! You have received a new order. Here are the details:';
        $details['buyer'] = 'Order placed by: '. Auth::user()->name ;
        foreach ($sellers as $seller) {
            $details['greeting'] =  'Hi '. $seller->name;
            Notification::route('mail', $seller->email)->notify(new OrderNotification($details));
        }

    }
}

