<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ItemPurchase;
use App\Mail\AllMail;
use App\Models\Seo;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Ad\Entities\Ad;

class PurchaseController extends Controller
{
    public function index()
    {
        $orders = ItemPurchase::with(['adDetails', 'customer'])->where('user_id', auth()->id())->orderBy('id', 'desc')->paginate();

        return view('frontend.purchase.index', compact('orders'));
    }

    public function view(ItemPurchase $order)
    {
        $order->load(
            ['review' => function ($q) use ($order) {

                $q->where('order_id', $order->id)->where('user_id', auth()->id());
            }]
        );




        return view('frontend.purchase.view', compact('order'));
    }

    public function update(ItemPurchase $order, Request $request)
    {

        $order->update(['status' => $request->status]);



        $data['status'] = "";

        if ($order->status == 4) {
            $data['status'] = "buyer got the item and not accepted";
        } elseif ($order->status == 5) {
            $data['status'] = "uyer got the item and accepted";
            $ad = Ad::find($order->ad_id);
            $ad->status = "sold";
            $ad->save();
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



        return redirect()->route('frontend.purchase.index')->with('success', "Order Status Update Successfully");
    }
}
