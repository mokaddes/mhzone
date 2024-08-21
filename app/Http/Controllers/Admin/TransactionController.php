<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TransactionDetails;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = TransactionDetails::latest('id')->paginate(10);
        return view('admin.transactions', compact('transactions'));
    }

    public function invoice($order_no)
    {
        $order = Order::where('order_number', $order_no)->first();
        if (!isset($order)) {
            abort(404);
        }
        $orderDetails = $order->orderDetails()->get()->groupBy('seller_id');
        $total = 0;
        foreach ($orderDetails as $seller_id => $orderDetail) {
            $orderDetail->seller = User::find($seller_id);
        }
        return view('admin.invoice', compact('order', 'orderDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sellerPayment($id, $status)
    {
        $trans = TransactionDetails::find($id);
        $trans->is_paid_to_seller = $status ;
        $trans->save();
        flashSuccess('Transaction Updated Successfully');
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
