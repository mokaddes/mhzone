<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Coupon\Entities\Coupon;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('id', 'desc')->paginate(30);

        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'valid_till' => 'required'
        ]);

        


        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->name = $request->name;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->discount = $request->discount;
        $coupon->valid_till = Carbon::parse($request->valid_till);
        $coupon->status = $request->status;
        $coupon->save();
        return redirect()->route('coupons.index')->with('success', 'Coupon Save successfully!');
    }

    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $request->validate([
            'code' => 'required|unique:coupons,code,'.$coupon->id,
            'valid_till' => 'required'
        ]);

        


        $coupon = Coupon::find($id);
        $coupon->code = $request->code;
        $coupon->name = $request->name;
        $coupon->coupon_type = $request->coupon_type;
        $coupon->discount = $request->discount;
        $coupon->valid_till = Carbon::parse($request->valid_till);
        $coupon->status = $request->status;
        $coupon->save();
        return redirect()->route('coupons.index')->with('success', 'Coupon Upadte successfully!');
    }

    public function delete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('coupons.index')->with('success', 'Coupon Deleted successfully!');
    }
}
