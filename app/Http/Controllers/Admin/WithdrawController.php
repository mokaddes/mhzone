<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdrawRequests=WithdrawRequest::with('seller')->orderBy('id','desc')->paginate(15);
        return view('admin.withdraw_request.index',compact('withdrawRequests'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(WithdrawRequest $withdrawRequest)
    {
        return view('admin.withdraw_request.edit',compact('withdrawRequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WithdrawRequest $withdrawRequest)
    {

        $withdrawRequest->approved_date=Carbon::now();
        $withdrawRequest->status=true;
        if($request->hasFile('image')){
            $withdrawRequest->screenshoot=uploadImage($request->image, 'slider');
        }
        $withdrawRequest->payment_by=$request->payment_by;
        $withdrawRequest->save();
        flashSuccess(' Payment Aproved');
        return redirect()->route('admin.withdrawRequest.index');
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
