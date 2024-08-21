<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\AdsSize;
use App\Models\UserShop;
use App\Models\Department;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Category\Entities\Category;

class UserShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (!is_seller()) {
//            return route('frontend.index');
//        }
        $user = User::find(Auth::id());
        $seller_shop = $user->userShop;
        if (isset($seller_shop)) {
            return redirect()->route('frontend.seller.shop', $seller_shop->slug);
        } else {
            return view('front.user.create_shop');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('front.user.create_shop');
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
        ],[
            'name.required' => 'Shop name is required.'
        ]);


        $user_shop = new UserShop();

        if ($request->hasFile('logo')) {
            $logo = uploadImage($request->logo, 'logo');
            $user_shop->logo = $logo;
        }

        if ($request->hasFile('banner')) {
            $banner = uploadImage($request->banner, 'banner');
            $user_shop->banner = $banner;
        }

        $slug = Str::slug($request->name);
        $data = UserShop::where('slug', $slug)->first();
        if (isset($data)) {
            $id = UserShop::max('id') + 1;
            $slug = $slug . '_' . $id;
        }
        $user_shop->name = $request->name;
        $user_shop->slug = $slug;
        $user_shop->user_id = auth()->id();
        $user_shop->status = 1;
        $user_shop->return_policy = $request->return_policy;
        $user_shop->location = $request->location;
        $user_shop->save();
        return redirect()->back()->with('success', 'Your shop created Successfully!');
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
        $request->validate([
            'name' => 'required',
        ],[
            'name.required' => 'Shop name is required.'
        ]);

        $user_shop = UserShop::find($id);

        if ($request->hasFile('logo')) {
            $logo = uploadImage($request->logo, 'logo');
            $user_shop->logo = $logo;
        }

        if ($request->hasFile('banner')) {
            $banner = uploadImage($request->banner, 'banner');
            $user_shop->banner = $banner;
        }
        $user_shop->name = $request->name;
        $user_shop->status = 1;
        $user_shop->return_policy = $request->return_policy;
        $user_shop->location = $request->location;
        $user_shop->save();
        return back()->with('success', 'Your shop updated Successfully!');
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
