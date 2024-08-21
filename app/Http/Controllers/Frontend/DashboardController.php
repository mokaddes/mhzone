<?php

namespace App\Http\Controllers\Frontend;

use App\Actions\Frontend\ProfileUpdate;
use App\Http\Controllers\Controller;
use App\Models\Admin\ShipingLocations;
use App\Models\Department;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserPlan;
use App\Notifications\AdDeleteNotification;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Modules\Ad\Entities\Ad;
use Modules\Plan\Entities\Plan;
use Modules\Wishlist\Entities\Wishlist;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function profile()
    {
        return view('front.user.profile');
    }

    public function switchMode($mode)
    {
        $user = User::find(Auth::id());
        $user->user_mode = $mode;
        $user->save();
        $status = 'Successfully switch to buyer mode';
        if ($mode == 1) {
            $status = 'Successfully switch to seller mode';
            Session::forget('cart');
        }

        return back()->with('success', $status);
    }

    public function myOrder()
    {

        if (is_seller()) {
            $ids = OrderDetail::where('seller_id', Auth::user()->id)->pluck(('order_id'))->toArray();
            $orders = Order::whereIn('id', $ids)->latest()->paginate(5);
        } else {
            $orders = Order::where('user_id', Auth::user()->id)->latest()->paginate(5);
        }

        return view('front.user.my_order', compact('orders'));
    }



    public function wishlist()
    {
        $ids = Wishlist::where('user_id', Auth::user()->id)->pluck('ad_id')->toArray();
        $items = Ad::findMany($ids);
        $departments = Department::all();
        return view('front.user.wishlist', compact('items', 'departments'));
    }


    public function wishlistRemove($id)
    {

        $wishlist = Wishlist::where('ad_id', $id)->first();
        $wishlist->delete();
        return redirect()->back()->with('success', 'Item Successfully Remove from Wishlist.');
    }


    public function profileEdit()
    {
        return view('front.user.edit_profile');
    }

    public function transaction()
    {
        $user = User::find(Auth::user()->id);
        $transactions = $user->userTransactions()->paginate(10);
        return view('front.user.transaction', compact('user', 'transactions'));
    }

    public function myAds()
    {
        if (!is_seller()) {
            return redirect()->route('frontend.index');
        }
        $ads = Ad::where('user_id', Auth::user()->id)->latest()->paginate(10);
        return view('front.user.my_ads', compact('ads'));
    }

    public function editAd(Ad $ad)
    {
        $data['user'] = auth()->user();
        $data['ad'] = $ad;
        return view('frontend.edit-ad', $data);
    }


    public function deleteMyAd(Ad $ad)
    {
        $ad->delete();

        flashSuccess('One of your ad has deleted');
        $this->addeleteNotification();
        return back();
    }

    public function addeleteNotification()
    {
        // Send ad create notification
        $user = auth('user')->user();
        if (checkSetup('mail')) {
            $user->notify(new AdDeleteNotification($user));
        }
    }

    public function myAdStatus(Ad $ad)
    {
        if ($ad->status == 'active') {
            $ad->status = 'sold';
        } elseif (($ad->status == 'sold')) {
            $ad->status = 'active';
        }
        $ad->update();

        flashSuccess('Status updated successfully!');
        return back();
    }

    public function favourites()
    {

        $isverify = auth('user')->user();

        if ($isverify->email_verified_at == null) {
            return redirect()->route('verification.notice');
        }

        $wishlistsIds = Wishlist::select('ad_id')
            ->customerData()
            ->pluck('ad_id')
            ->all();


        $query = Ad::select(['id', 'title', 'slug', 'thumbnail', 'price', 'status', 'category_id', 'created_at'])
            ->with('category:id,name')
            ->whereIn('id', $wishlistsIds);

        if (request()->has('keyword') && request()->keyword != null) {
            $keyword = request('keyword');
            $query->where('title', 'LIKE', "%$keyword%");
        }

        if (request()->has('category') && request()->category != null) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        if (request()->has('sort_by') && request()->sort_by != null && request('sort_by') == 'oldest') {
            $query->orderBy('id', 'ASC');
        } else {
            $query->orderBy('id', 'DESC');
        }

        $data['wishlists'] = $query->paginate(5)->withQueryString();

        return view('frontend.favourite-ads', $data);
    }

    public function message()
    {
        $user['user'] = auth()->user();
        return view('frontend.message', $user);
    }

    public function plansBilling()
    {
        storePlanInformation();
        $data['user_plan'] = session('user_plan');

        if ($data['user_plan']->subscription_type == 'recurring' && $data['user_plan']->current_plan_id) {
            $data['user_plan'] = $data['user_plan'];
            $data['current_plan'] = Plan::find($data['user_plan']->current_plan_id);
        }

        $data['plan_info'] = UserPlan::customerData()->firstOrFail();
        $data['transactions'] = Transaction::with('plan')->customerData()->latest()->get()->take(5);

        return view('frontend.plans-billing', $data);
    }

    public function cancelPlan()
    {
        $user_plan = auth('user')->user()->userPlan;
        $plan = Plan::find($user_plan->current_plan_id);

        $user_plan->update([
            'ad_limit' => $user_plan->ad_limit ? $user_plan->ad_limit - $plan->ad_limit : 0,
            'featured_limit' => $user_plan->featured_limit ? $user_plan->featured_limit - $plan->featured_limit : 0,
            'current_plan_id' => null,
            'expired_date' => null,
        ]);

        flashSuccess('Plan cancelled successfully!');
        return back();
    }

    public function accountSetting()
    {

        $isverify = auth('user')->user();

        if ($isverify->email_verified_at == null) {
            return redirect()->route('verification.notice');
        }

        $user = auth('user')->user();
        $social_medias = $user->socialMedia;
        $locations = ShipingLocations::where('status', true)->get();

        return view('frontend.account-setting', compact('user', 'social_medias', 'locations'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name' => "required",
            'phone' => "required|unique:users,phone," . Auth::id(),
            'email' => "required|email|unique:users,email," . Auth::id(),
        ], [
            'name.required' => 'The name field is required.',
            'phone.required' => 'The phone field is required.',
            'phone.unique' => 'The phone number is already exists.',
            'email.required' => 'The name field is required',
            'email.unique' => 'The email address is already exists.',
        ]);
        if ($request->get('change_password') == '1') {

            $request->validate([
                'current_password' => ["required", function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail(__('The :attribute is incorrect.'));
                    }
                }],
                'password' => "required|confirmed|min:8|max:50",
            ], [
                'current_password.required' => 'The current password field is required',
                'password.required' => 'The new password field is required',
                'password.confirmed' => 'The new password must be confirmed',
                'password.min' => 'The password at least 8 character length.',
                'password.max' => 'The password maximum 50 character length.',
            ]);
        }

        try {
            $customer = ProfileUpdate::update($request, Auth::user());

            if ($customer) {
                flashSuccess('Profile Updated Successfully');
                return back();
            }
        } catch (\Exception $e) {
            flashError($e->getMessage());
            return back();
        }
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        $password_check = Hash::check($request->current_password, auth('user')->user()->password);

        if ($password_check) {
            $user = User::findOrFail(auth('user')->id());
            $user->update([
                'password' => bcrypt($request->password),
                'updated_at' => Carbon::now(),
            ]);

            flashSuccess('Password Updated Successfully');
            return back();
        } else {
            flashError('Something went wrong');
            return back();
        }
    }

    public function socialUpdate(Request $request)
    {
        // return $request;
        $user = auth('user')->user();

        $user->socialMedia()->delete();
        // $user->socialMedia()->createMany($request->all());

        $social_medias = $request->social_media;
        $urls = $request->url;

        foreach ($social_medias as $key => $value) {
            if ($value) {
                $user->socialMedia()->create([
                    'social_media' => $value,
                    'url' => $urls[$key],
                ]);
            }
        }

        flashSuccess('Social Media Updated Successfully');
        return back();


        // $request->validate([
        //     'current_password' => ['required', new MatchOldPassword],
        //     'password' => 'required|string|min:8|confirmed',
        //     'password_confirmation' => 'required',
        // ]);
        // $password_check = Hash::check($request->current_password, auth('user')->user()->password);

        // if ($password_check) {
        //     $user = User::findOrFail(auth('user')->id());
        //     $user->update([
        //         'password' => bcrypt($request->password),
        //         'updated_at' => Carbon::now(),
        //     ]);

        //     flashSuccess('Password Updated Successfully');
        //     return back();
        // } else {
        //     flashError('Something went wrong');
        //     return back();
        // }
    }

    public function addToWishlist(Request $request)
    {
        $ad = Ad::findOrFail($request->ad_id);
        $data = Wishlist::where('ad_id', $request->ad_id)->whereUserId($request->user_id)->first();
        if ($data) {
            $data->delete();

            $user = auth('user')->user();
            $seller = User::findOrFail($ad->user_id);
            // if (checkSetup('mail')) {
            //     $seller->notify(new AdWishlistNotification($user, 'remove', $ad->slug));
            // }
            flashSuccess('Ad removed from wishlist');
        } else {
            Wishlist::create([
                'ad_id' => $request->ad_id,
                'user_id' => $request->user_id
            ]);

            $user = auth('user')->user();

            // if (checkSetup('mail')) {
            //     $seller->notify(new AdWishlistNotification($user, 'add', $ad->slug));
            // }
            flashSuccess('Ad added to wishlist');
        }
        resetSessionWishlist();

        return back();
    }

    
    public function deleteAccount(Request $request, $id)
    {
        $request->validate([
            'del_acc' => 'required',
        ]);
        
        $user = User::findOrFail($id);

        $ads_exists = DB::table('ads')->where('user_id', $user->id)->first();
        
        if($ads_exists) {
            flashError('You can not delete your account due to exists your ads. Please at first delete your ads.');
            return redirect()->back();
        }
        
        if($request->del_acc === "delete"){
            $user->delete();
            Auth::guard('user')->logout();
        }else {
            flashError('You cannot delete your account due typing mistake!');
            return redirect()->back();
        }

        flashSuccess('Your account was successfully deleted. Thank you to use erthoo.com');
        return redirect()->route('frontend.signup');

    }

    // public function deleteAccount(User $customer)
    // {
    //     // dd($customer);
    //     $ads_exists = DB::table('ads')->where('user_id', $customer->id)->first();
    //     // dd($ads_exists);
    //     if($ads_exists) {
    //         flashError('You can not delete your account due to exists your ads. Please at first delete your ads.');
    //         return redirect()->back();
    //     }

    //     $customer->delete();

    //     Auth::guard('user')->logout();

    //     flashSuccess('Your account was successfully deleted. Thank you to use erthoo.com');
    //     return redirect()->route('frontend.signup');

    // }

    /**
     * Update ad status to expire
     *
     * @param Ad $ad
     *
     * @return void
     */
    public function markExpired(Ad $ad)
    {
        $ad->update([
            'status' => 'sold'
        ]);

        flashSuccess('Status updated successfully!');
        return back();
    }

    /**
     * Update ad status to expire
     *
     * @param Ad $ad
     *
     * @return void
     */
    public function markActive(Ad $ad)
    {
        $ad->update([
            'status' => 'active'
        ]);

        flashSuccess('Status updated successfully!');
        return back();
    }

    /**
     * View Post Rules Page
     *
     * @return View
     */
    public function postRules()
    {
        return view('frontend.posting-rules')->withSetting(Setting::first());
    }


    public function myAddresses()
    {
        return view('frontend.my-addresses');
    }


    public function mySizes(Request $request)
    {
        $auth_id = Auth::id();

        $my_category = Ad::select('category_id')->with(['category:id,name,icon'])->where('user_id', $auth_id)->groupBy('category_id')->get();

        $my_scategory = Ad::select('category_id', 'subcategory_id')->with(['subcategory:id,name'])->where('user_id', $auth_id)->groupBy('subcategory_id')->get();


        $my_size = Ad::select('size_id', 'category_id', 'subcategory_id')->with(['adSize:id,size'])->where('user_id', $auth_id)->groupBy('size_id')->get();


        return view('frontend.my-sizes', compact('my_category', 'my_scategory', 'my_size'));
    }

    public function mysettings()
    {
        return view('frontend.my-settings');
    }

    public function usernameValid(Request $request)
    {
        $checkusername = User::where('username', $request->username)->first();

        if ($checkusername) {
            if ($checkusername->id == Auth::id()) {
                $result = 3;
                return response()->json(['success' => 'This is you current username', 'result' => $result]);
            } else {
                $result = 1;
                return response()->json(['success' => 'Username already taken ', 'result' => $result]);
            }
        } else {
            $result = 2;
            return response()->json(['success' => 'Username is available', 'result' => $result]);
        }
    }


}
