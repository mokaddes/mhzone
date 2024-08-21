<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Order;
use App\Models\ItemPurchase;
use App\Notifications\OrderNotification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    // public function index()
    // {
    //     $orders=ItemPurchase::with(['adDetails','customer','owner'])->paginate(20);

    //     return view('admin.order.index',compact('orders'));
    // }

    public function index()
    {
        $orders=Order::with(['orderDetails','buyer','transactionDetails'])->paginate(10);

        return view('admin.order.index',compact('orders'));
    }

    public function orderDetails($order_no){
        $order = Order::where('order_number', $order_no)->first();
        if (!isset($order)) {
            abort(404);
        }
        $orderDetails = $order->orderDetails()->get()->groupBy('seller_id');
        $total = 0;
        foreach ($orderDetails as $seller_id => $orderDetail) {
            $orderDetail->seller = User::find($seller_id);
        }
        return view('admin.order.view', compact('order', 'orderDetails'));
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
}
