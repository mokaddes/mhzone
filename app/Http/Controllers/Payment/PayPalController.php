<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use Modules\Plan\Entities\Plan;
use App\Http\Traits\PaymentTrait;
use App\Http\Controllers\Controller;
use App\Mail\AllMail;
use App\Models\Admin;
use App\Models\ItemPurchase;
use App\Models\Seo;
use App\Models\Setting;
use App\Models\Transaction;
use App\Notifications\MembershipUpgradeNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Modules\Ad\Entities\Ad;
use Srmklive\PayPal\Facades\PayPal;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Log;




class PayPalController extends Controller
{
    use PaymentTrait;

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $plan = session('plan');
        $converted_amount = currencyConversion($plan->price);
        session(['order_payment' => [
            'payment_provider' => 'paypal',
            'amount' =>  $converted_amount,
            'currency_symbol' => '$',
            'usd_amount' =>  $converted_amount,
        ]]);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.successTransaction', [
                    'plan_id' => $plan->id,
                    'amount' => $converted_amount
                ]),
                "cancel_url" => route('paypal.cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => 'USD',
                        "value" => $converted_amount,
                    ]
                ]
            ]
        ]);
        // dd($response['id']);
        if (isset($response['id'])) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            session()->flash('error', 'Something went wrong.');
            return back();
        } else {
            session()->flash('error', 'Something went wrong.');
            return back();
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // After Payment Successfully
            session(['transaction_id' => $response['id'] ?? null]);
            $this->orderPlacing();
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




    public function processPaypal(Request $request)
    {
        try {



            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('processSuccess', $request->all()),
                    "cancel_url" => route('processCancel'),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $request->amount
                        ]
                    ]
                ]

            ]);


            if (isset($response['error']) && $response['error'] !== null) {



                session()->flash('error', $response['error']['message']);
                return back();
            }



            if (isset($response['id']) && $response['id'] != null) {
                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {

                        session()->flash('success', 'Payment Success');
                        return redirect()->away($links['href']);
                    }
                }
            } else {
                return redirect()->away($links['href']);
            }
        } catch (\Exception $th) {
            session()->flash('error', $th->getMessage());
            return back();
        }




        //     return redirect()
        //         ->route('createpaypal')
        //         ->with('error', 'Something went wrong.');
        // } else {
        //     return redirect()
        //         ->route('createpaypal')
        //         ->with('error', $response['message'] ?? 'Something went wrong.');
        // }
    }





    public function processSuccess(Request $request)

    {

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {



            $itemPurchase = new ItemPurchase();
            $itemPurchase->ad_id = $request->ad_id;
            $itemPurchase->user_id = $request->user_id;
            $itemPurchase->unit_price = $request->unit_price;
            $itemPurchase->units = $request->units;
            $itemPurchase->total_price = $request->total_price;
            $itemPurchase->total_dicount = $request->total_dicount;
            $itemPurchase->grand_total = $request->grand_total;
            $itemPurchase->status = $request->status;
            $itemPurchase->created_by = $request->created_by;
            $itemPurchase->updated_by = $request->updated_by;
            $itemPurchase->admin_commission_percent = $request->admin_commission_percent;
            $itemPurchase->admin_commission = $request->admin_commission;
            $itemPurchase->shiping_to = $request->shiping_to;
            $itemPurchase->save();




            Transaction::create([
                'order_id' => $itemPurchase->id,
                'transaction_id' =>  $response['id'],
                'user_id' => auth('user')->id(),
                'item_id' => $request->ad_id,
                'payment_provider' => "Paypal",
                'amount' => $request->grand_total,
                'currency_symbol' => "$",
                'usd_amount' => $request->grand_total,
                'payment_status' => $response['status'],
            ]);




            $adDetails = Ad::with(['adSize', 'adColor', 'customer'])->find($request->ad_id);



            // Ess
            $data['setting'] = Setting::first();
            $data['about'] = Seo::where('page_slug', 'about')->first();
            $data['subject'] = "Purchase Notification";
            $data['tempalte'] = "purchase-notifications";
            $data['to'] = Auth::user();

            $data['adDetails'] = $adDetails;

            Mail::to($data['to']->email)->send(new AllMail($data));






            // Ess
            $data['setting'] = Setting::first();
            $data['about'] = Seo::where('page_slug', 'about')->first();
            $data['subject'] = "User Purchase Notification";
            $data['tempalte'] = "purchase-notifications-admin";

            $data['to'] = Admin::first();
            $data['user'] = Auth::user();
            $data['owoner'] = $adDetails->customer->name;

            Mail::to($data['to']->email)->send(new AllMail($data));









            return redirect()
                ->route('frontend.ad.details', ['ad' => $adDetails->slug])
                ->with('success', 'Transaction complete.');
        } else {


            return redirect()->back()
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }



    public function processCancel(Request $request)

    {

        return redirect()
            ->route('createpaypal')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
