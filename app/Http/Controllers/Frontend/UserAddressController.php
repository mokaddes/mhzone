<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        return view('front.user.save_address', compact('shipping_address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data  = view('front.user._address_create')->render();
        return response()->json([
         'status'=>true,
         'data'=>$data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'apartment' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'address_type' => 'required',
        ],[
                'name.required' => 'Address Name field is is required.',
                'phone.required' => 'Address Phone Number is required.',
                'apartment.required' => 'Apartment is required!',
                'state.required' => 'State is required!',
                'city.required' => 'City is required!',
                'address.required' => 'Address is required!',
                'address_type.required' => 'Address type is required!',
            ]
        );

        $shipping_address = new ShippingAddress();
        $shipping_address->name = $request->name;
        $shipping_address->phone = $request->phone;
        $shipping_address->user_id = auth()->id();
        $shipping_address->apartment = $request->apartment;
        $shipping_address->state = $request->state;
        $shipping_address->city = $request->city;
        $shipping_address->postcode = $request->postcode;
        $shipping_address->address = $request->address;
        $shipping_address->address_type = $request->address_type;
        $shipping_address->save();
        if(request()->ajax())
        {
            return response()->json([
                'status'=>true,
                'message'=>'Shipping Address Created Successfully!',
                'data'=>$shipping_address,
            ]);
        }

        return redirect()->back()->with('success', 'Shipping Address Created Successfully!');
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
    public function edit($id)
    {
       $address = ShippingAddress::find($id);
       $data  = view('front.user._address_edit', compact('address'))->render();
       return response()->json([
        'status'=>true,
        'data'=>$data,
       ]);
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
        $shipping_address = ShippingAddress::find($id);
        $request->validate([
            // 'phone' => 'required|unique:shipping_addresses,phone,'.$shipping_address->id,
            'name' => 'required',
            'phone' => 'required',
            'apartment' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'address_type' => 'required',
        ],[
                'phone.required' => 'Address Phone Number is Unique.',
                'phone.unique' => 'Address Phone Number is required.',
                'apartment.required' => 'Apartment is required!',
                'state.required' => 'State is required!',
                'city.required' => 'City is required!',
                'address.required' => 'Address is required!',
                'address_type.required' => 'Address type is required!',
            ]
        );
        $shipping_address->name = $request->name;
        $shipping_address->phone = $request->phone;
        $shipping_address->user_id = auth()->id();
        $shipping_address->apartment = $request->apartment;
        $shipping_address->state = $request->state;
        $shipping_address->city = $request->city;
        $shipping_address->postcode = $request->postcode;
        $shipping_address->address = $request->address;
        $shipping_address->address_type = $request->address_type;
        $shipping_address->save();
        if(request()->ajax())
        {
            return response()->json([
                'status'=>true,
                'message'=>'Shipping Address Updated Successfully!',
                'data'=>$shipping_address,
            ]);
        }
        return redirect()->back()->with('success', 'Shipping Address Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {

            $shipping_address = ShippingAddress::find($id);
            $shipping_address->delete();

        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            return redirect()->back()->with('error', 'Something went wrong please try again');
        }
        DB::commit();
        return redirect()->back()->with('success', 'Shipping address successfully deleted!');
    }
}
