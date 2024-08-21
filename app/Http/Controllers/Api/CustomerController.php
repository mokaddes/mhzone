<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Transaction;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Modules\Plan\Entities\Plan;
use App\Http\Traits\MobileTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlanResource;
use Illuminate\Support\Facades\Hash;
use App\Actions\Frontend\ProfileUpdate;
use App\Http\Controllers\Api\Response;
use App\Http\Requests\Api\ProfileUpdateFormRequest;
use App\Http\Resources\Api\CustomerPlanResource;
use Modules\Wishlist\Entities\Wishlist;
use App\Http\Resources\InvoiceMobileResource;
use App\Notifications\AdWishlistNotification;
use Modules\Ad\Transformers\AdResourceMobile;
use App\Http\Resources\CustomerFavouriteAdsResource;
use App\Http\Resources\CustomerNotificationResource;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Response
{
    use MobileTrait;

    public function passwordUpdate(Request $request)
    {
        $customer = User::findOrFail(auth('api')->id());

        $validator = Validator::make($request->all(), [
            'current_password' => ['required', new MatchOldPassword],
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return parent::sendError("validation Error", $validator->errors()->first());
        }

        $password_check = Hash::check($request->current_password, $customer->password);

        if ($password_check) {
            $customer->update(['password' => bcrypt($request->password)]);

            return parent::sendResponse(200, "Password Updated", $customer);
        } else {
            return parent::sendError('Invalid', "Current password did'nt match with our records");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $user_id = auth()->guard('api')->id();

        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => "required|email|unique:users,email,{$user_id}",
            'phone' => "sometimes|nullable",
            'web' => "sometimes|nullable|url",
            'image' => "sometimes|nullable",
        ]);
        if ($validate->fails()) {
            return parent::sendError('Validation Error', $validate->errors()->first());
        }

        try {
            $base64 = $request->base64 ?? true;
            $customer = User::find(auth('api')->id());

            $customer->update($request->except(['image', 'base64']));

            if ($base64 && $request->image) {
                $url = uploadBase64FileToPublic($request->image, 'uploads/customer/');
                $customer->update(['image' => $url]);
            } else {
                if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    $url = $request->image->move('uploads/customer', $request->image->hashName());
                    $customer->update(['image' => $url]);
                }
            }

            if ($customer) {
                return parent::sendResponse(200, "Profile Update Successfully", $customer);
            }
        } catch (\Exception $e) {
            return parent::sendError(200, "Something Worng");
        }
    }

    public function allAds(Request $request)
    {
        $filter =  $request->filter;
        $sort =  $request->sort;
        $paginate = $request->paginate ?? false;

        $ads =  Ad::with('category')->whereUserId(auth('api')->id());

        if ($filter == 'active') {
            $ads = $ads->whereStatus('active');
        } elseif ($filter == 'sold') {
            $ads = $ads->whereStatus('sold');
        }

        if ($sort == 'latest') {
            $ads = $ads->latest('id');
        } elseif ($sort == 'popular') {
            $ads = $ads->latest('total_views');
        } elseif ($sort == 'featured') {
            $ads = $ads->where('featured', 1);
        }

        if ($paginate) {
            $ads = $ads->simplePaginate($paginate);
        } else {
            $ads = $ads->get();
        }

        return parent::sendResponse(200, "Customer Ads", $ads);
    }

    public function recentAds(Request $request)
    {
        $paginate = $request->paginate ?? false;

        $recent_ads = Ad::customerData(true)->with('category')->latest('id');

        if ($paginate) {
            $recent_ads = $recent_ads->simplePaginate($paginate);
        } else {
            $recent_ads = $recent_ads->get();
        }

        return parent::sendResponse(200, "Recent Ads", $recent_ads);
    }

    public function activeAd(Ad $ad)
    {
        if ($ad->user_id != auth('api')->id()) {
            return parent::sendError('Invalid Ads', "Invalid Ads");
        }

        if ($ad->status != 'active') {
            return parent::sendError('Invalid Ads', 'Ad is already active');
        }

        $ad->update([
            'status' => 'active'
        ]);

        return parent::sendResponse(200, 'Ad mark as active', $ad);
    }

    public function expireAd(Ad $ad)
    {
        if ($ad->user_id != auth('api')->id()) {
            return parent::sendError('invalid Ad', 'You are not allowed to do this action');
        }

        if ($ad->status != 'active') {
            return parent::sendError('Invalid Ad', 'Ad is already sold');
        }

        $ad->update([
            'status' => 'sold'
        ]);

        return parent::sendResponse(200, 'Ad mark as sold', $ad);
    }

    public function deleteAd(Ad $ad)
    {
        if ($ad->user_id != auth('api')->id()) {
            return parent::sendError('invalid Ad', 'You are not allowed to do this action');
        }

        $ad->delete();
        $this->addeleteNotification();
        return parent::sendResponse(200, 'Ad deleted successfully', $ad);
    }

    public function deleteCustomer()
    {
        $customer = User::find(auth('api')->id());
        $customer->delete();
        auth('api')->logout();
        return parent::sendResponse(200, 'Account deleted successfully');
    }

    public function favouriteAddRemove(Ad $ad)
    {
        $customer = User::find(auth('api')->id());


        $data = Wishlist::where('ad_id', $ad->id)->whereUserId($customer->id)->first();

        $wishlist = Wishlist::where('user_id', $customer->id)->get();

        if ($data) {
            $data->delete();

            if (checkSetup('mail')) {
                $customer->notify(new AdWishlistNotification($customer, 'add', $ad->slug));
            }
            return parent::sendResponse(200, 'Ad removed from wishlist', $wishlist);
        } else {
            Wishlist::create([
                'ad_id' => $ad->id,
                'user_id' => $customer->id
            ]);

            if (checkSetup('mail')) {
                $customer->notify(new AdWishlistNotification($customer, 'add', $ad->slug));
            }
            return parent::sendResponse(200, 'Ad removed from wishlist', $wishlist);
        }
    }

    public function recentInvoice()
    {
        $transaction = Transaction::with('plan:id,label')->customerData(true)->latest()->get()->take(5);
        return parent::sendResponse(200, 'User Transaction', $transaction);
    }

    public function favouriteAds(Request $request)
    {
        $paginate = $request->paginate ?? false;

        $ads =  Wishlist::with('ad')->whereUserId(auth('api')->id())->latest();

        if ($paginate) {
            $ads = $ads->simplePaginate($paginate);
        } else {
            $ads = $ads->get();
        }

        return parent::sendResponse(200, 'User Favorite Add List', $ads);
    }

    public function activityLogs()
    {

        $user = User::find(auth('api')->id());
        $notifications = $user->notifications()->latest()->limit(5)->get();;

        return parent::sendResponse(200, "User Notification", $notifications);
    }

    public function dashboardOverview()
    {
        $ads = Ad::customerData(true)->get();
        $posted_ads_count = $ads->count();
        $expire_ads_count = $ads->where('status', 'sold')->count();
        $active_ads_count = $ads->where('status', 'active')->count();
        $favourite_count = Wishlist::whereUserId(auth('api')->id())->count();

        $data = [
            'posted_ads_count' => $posted_ads_count,
            'active_ads_count' => $active_ads_count,
            'expire_ads_count' => $expire_ads_count,
            'favourite_ads_count' => $favourite_count
        ];

        return parent::sendResponse(200, "Dashboard Overview", $data);
    }

    public function adsViewsSummery()
    {
        $bar_chart_datas = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        for ($i = 0; $i < 12; $i++) {
            $bar_chart_datas[$i] = (int)Ad::customerData(true)
                ->select('total_views')
                ->whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $i + 1)
                ->sum('total_views');
        }

        return response()->json([
            'success' => true,
            'data' => [
                'month_wise_views' => $bar_chart_datas
            ]
        ], Response::HTTP_OK);
    }

    public function planLimit()
    {
        return response()->json([
            'success' => true,
            'plan' => new CustomerPlanResource(auth('api')->user()->userPlan)
        ], Response::HTTP_OK);
    }

    public function planUpgradeTesting(Request $request)
    {
        auth('api')->user()->userPlan->update([
            'ad_limit' => $request->ad_limit,
            'featured_limit' => $request->featured_limit,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Plan updated successfully',
            'plan' => new CustomerPlanResource(auth('api')->user()->userPlan)
        ], Response::HTTP_OK);
    }
}
