<?php

namespace Modules\Coupon\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Coupon\Entities\Coupon;
use Illuminate\Contracts\Support\Renderable;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $coupons = Coupon::paginate(30);
        return view('coupon::index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('coupon::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable',
            'coupons' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);

        $coupon = DB::table('coupons')->insert($data);
        if ($coupon) {
            flashSuccess('Coupon Created Successfully');
        } else {
            flashError();
        }


        return redirect()->route('module.coupon.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('coupon::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view('coupon::edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'coupons' => 'required',
            'price' => 'required',
            'status' => 'required',
        ]);
        $coupon = Coupon::find($id);
        $coupon->name = $request->name;
        $coupon->coupons = $request->coupons;
        $coupon->price = $request->price;
        $coupon->status = $request->status;
        $coupon->update();

        flashSuccess('Coupon Updated Successfully');

        return redirect()->route('module.coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        flashSuccess('Coupon Deleted Successfully');

        return redirect()->route('module.coupon.index');
    }
}
