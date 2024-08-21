<?php

namespace App\Http\Controllers;

use App\Mail\AdRequestMail;
use App\Mail\AllMail;
use App\Models\ItemPurchase;
use App\Models\RequestedProduct;
use App\Models\Seo;
use App\Models\Setting;
use App\Models\User;
use Google\Service\CloudSearch\Id;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Ad\Entities\Ad;

class RequestedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requestedProducts = RequestedProduct::with('ads')->where('request_to', auth()->id())->paginate(10);



        return view('frontend.my_requested_ad', compact('requestedProducts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $ad = Ad::find($request->ad_id);
        $sold_item = ItemPurchase::where('ad_id', $ad->id)->first();
        
        if (isset($sold_item) && isset($sold_item->user_id)) {
            $buyer = User::find($sold_item->user_id);
        } else {
            $buyer = User::find($request->owner_id);
        }
        





        $requestedProduct = new RequestedProduct();
        $requestedProduct->ads_id = $request->ad_id;
        $requestedProduct->request_to = $buyer->id;
        $requestedProduct->request_form = auth()->id();
        $requestedProduct->offer_price = $request->price;
        $requestedProduct->status = 0;
        $requestedProduct->save();


        if ($requestedProduct) {
            // Ess
            $data['setting'] = Setting::first();
            $data['about'] = Seo::where('page_slug', 'about')->first();
            $data['subject'] = "Ad Request Notification";
            $data['tempalte'] = "ad-request";
            $data['to'] =  $buyer->email;
            $data['sender'] = User::find(auth()->id());
            $data['adTitle'] = $ad->title;
            $data['slug'] = $ad->slug;
            $data['request_data'] = $requestedProduct;
            Mail::to($data['to'])->send(new AllMail($data));
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestedProduct  $requestedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(RequestedProduct $requestedProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestedProduct  $requestedProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestedProduct $requestedProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestedProduct  $requestedProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RequestedProduct $requestedProduct)
    {
        $requestedProduct->status = true;
        $requestedProduct->save();
        $ad = Ad::find($requestedProduct->ads_id);
        $ad->status = "active";
        $ad->save();
        flashSuccess('Product Acivate');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestedProduct  $requestedProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestedProduct $requestedProduct)
    {
        //
    }
}
