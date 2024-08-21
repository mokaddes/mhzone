<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\AllMail;
use App\Models\Admin;
use App\Models\ItemPurchase;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Seo;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function index()
    {
        $orders = ItemPurchase::with(['adDetails', 'customer'])->where('created_by', auth()->id())->orderBy('id', 'desc')->paginate(10);

        return view('frontend.order.index', compact('orders'));
    }

    public function orderDetails($order_no)
    {
        $order = Order::where('order_number', $order_no)->first();
        if (!isset($order)) {
            abort(404);
        }
        if (is_seller()) {
            $orderDetails = $order->orderDetails()->where('seller_id', Auth::user()->id)->get()->groupBy('seller_id');
        } else {
            $orderDetails = $order->orderDetails()->get()->groupBy('seller_id');
        }
        $total = 0;
        foreach ($orderDetails as $seller_id => $orderDetail) {
            $orderDetail->seller = User::find($seller_id);
        }
        return view('front.user.order-details', compact('order', 'orderDetails'));
    }

    public function changeStatus(Request $request, $id)
    {
        $status = $request->status;
        $seller_id = $request->seller_id;
        $order = Order::find($id);
        $orderDetails = OrderDetail::where('order_id', $id)->where('seller_id', $seller_id)->get();
        foreach ($orderDetails as $orderDetail) {
            $orderDetail->status = $status;
            $orderDetail->save();
        }
        $this->sendOrderMail($order, $status, $seller_id);

        return back()->with('success', 'Status updated successfully');
    }

    public function sendOrderMail($order, $status, $seller_id)
    {

        $seller = User::find($seller_id);
        $shipping_address = $order->apartment . ' ' . $order->address . ', ' . $order->city . ', ' . $order->state . '-' . $order->postcode;

        $details = [
            'subject' => 'Changing status of your order in ' . env('APP_NAME'),
            'greeting' => 'Hi ' . Auth::user()->name,
            'body' => 'Order status is updated to ' . $status,
            'order_no' => 'Order Number: #', $order->order_number,
            'order_date' => 'Order Date: ' . date('d M, Y'),
            'shipping' => 'Shipping Address: ' . $shipping_address,
            'status' => 'Order Status: ' . ucfirst($status),
            'action' => route('frontend.order.details', $order->order_number),
            'thanks' => 'Thanks for being with ' . env('APP_NAME'),
        ];

        $admin = Admin::first();
        Notification::route('mail', $order->buyer->email)->notify(new OrderNotification($details));
        $details['buyer'] = 'Order placed by: ' . $order->buyer->name;
        $details['greeting'] = 'Hi ' . $admin->name;
        Notification::route('mail', $admin->email)->notify(new OrderNotification($details));

        $details['body'] = 'Congratulations! You have received a new order. Here are the details:';
        $details['buyer'] = 'Order placed by: ' . $order->buyer->name;
        $details['greeting'] = 'Hi ' . $seller->name;
        Notification::route('mail', $seller->email)->notify(new OrderNotification($details));

    }

    public function view(ItemPurchase $order)
    {
        return view('frontend.order.view', compact('order'));
    }

    public function update(Request $request, ItemPurchase $order)
    {
        $order->update(['status' => $request->status]);


        $data['status'] = "";

        if ($order->status == 1) {
            $data['status'] = "Ordered and paid";
        } elseif ($order->status == 2) {
            $data['status'] = "Seller delivered";
        } elseif ($order->status == 3) {
            $data['status'] = "Buyer got the item ";
        }


        // Essnsial data
        $data['setting'] = Setting::first();
        $data['about'] = Seo::where('page_slug', 'about')->first();
        $data['subject'] = "Selling Notification";
        $data['tempalte'] = "purchase-status-update-notifications-user";
        $data['to'] = $order->owner;

        //   External Data

        $data['adDetails'] = $order->adDetails;

        Mail::to($data['to']->email)->send(new AllMail($data));

        $data['to'] = $order->customer;
        $data['subject'] = "Buying Notification";
        $data['tempalte'] = "purchase-status-update-notifications-buyer";
        Mail::to($data['to']->email)->send(new AllMail($data));

        return redirect()->route('frontend.orders.index')->with('success', "Order Status Update Successfully");
    }

    public function invoice($order_no)
    {
        $order = Order::where('order_number', $order_no)->first();
        if (!isset($order)) {
            abort(404);
        }
        if (is_seller()) {
            $orderDetails = $order->orderDetails()->where('seller_id', Auth::user()->id)->get()->groupBy('seller_id');
        } else {
            $orderDetails = $order->orderDetails()->get()->groupBy('seller_id');
        }
        $total = 0;
        foreach ($orderDetails as $seller_id => $orderDetail) {
            $orderDetail->seller = User::find($seller_id);
        }
        return view('front.invoice', compact('order', 'orderDetails'));
    }
}
