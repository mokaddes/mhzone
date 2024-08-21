<?php

namespace App\Http\Controllers;

use App\Models\ItemPurchase;
use App\Models\Setting;
use App\Models\WithdrawRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Currency\Entities\Currency;

class WithdrawRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdrawRequests=WithdrawRequest::where('seller_id',Auth::id())->get();
        return view('frontend.withdraw_request.index',compact('withdrawRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $amount=ItemPurchase::where('created_by',auth()->id())->where('status',4)->sum('grand_total');
        $currency=Currency::first();
        return view('frontend.withdraw_request.create',compact('amount','currency'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $withdrawRequest=new WithdrawRequest();
        $withdrawRequest->seller_id=auth()->id();
        $withdrawRequest->amount=$request->amount;
        $withdrawRequest->withdraw_request_date=Carbon::now();
        $withdrawRequest->status=0;
        $withdrawRequest->save();
        return redirect()->route('frontend.withdrawRequest')->with('success', 'Your request is submitted wait for approved.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(WithdrawRequest $withdrawRequest)
    {
        return view('frontend.withdraw_request.view',compact('withdrawRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
