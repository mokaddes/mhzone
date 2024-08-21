<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\UserFollower;
use Modules\Ad\Transformers\AdResource;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Modules\CustomField\Entities\CustomFieldValue;
use Modules\Review\Entities\Review;

class SellerDashboardController extends Controller
{
    public function profile(User $user, Request $request, $cat = null, $subcat = null)
    {


        if (!session()->has('seller_tab')) {
            session(['seller_tab' => 'ads']);
        }

        $ads = Ad::where('user_id', $user->id)->get('id');
        $ads_array = [];
        foreach ($ads as  $id) {

            array_push($ads_array, $id->id);
        }

        // $reviews =$user->reviews;

        $reviews = Review::with(['ads' => function ($q) use ($user) {
            $q->with(['category', 'subcategory', 'childcategory'])->where('user_id', $user->id);
        }])->whereIn('item_id', $ads_array)->get();




        $rating_details = [
            'total' => $reviews->count(),
            'rating' => $reviews->sum('stars'),
            'average' => number_format($reviews->avg('stars')),
        ];


        $query = Ad::with(['category:id,name', 'childcategory:id,name', 'adSize:id,category_id,size']);



        if (isset($cat)) {
            $query->whereHas('category', function ($q) use ($cat) {
                $q->where('slug', $cat);
            });
        }



        if (isset($subcat)) {
            $query->whereHas('subcategory', function ($q) use ($subcat) {
                $q->whereIn('slug', [$subcat]);
            });
        }

        if ($request->has('childcategory') && $request->childcategory != null) {
            $childcategory = $request->childcategory;

            $query->whereHas('childcategory', function ($q) use ($childcategory) {

                $q->whereIn('slug', $childcategory);
            });
        }





        if (isset($cat) || isset($subcat)) {
            if (isset($cat)) {
                $category = Category::where('slug', $cat)->first();

                if ($category) {
                    $data['searchable_fields'] = $category->customFields->where('filterable', 1)->map(function ($field) {
                        $field->values = CustomFieldValue::where('custom_field_id', $field->id)->get();
                        return $field;
                    });
                } else {
                    $data['searchable_fields'] = [];
                }
            } else {
                $category = SubCategory::where('slug', $subcat)->first();


                if ($category) {
                    $category = $category->category;
                    $data['searchable_fields'] = $category->customFields->where('filterable', 1)->map(function ($field) {
                        $field->values = CustomFieldValue::where('custom_field_id', $field->id)->get();
                        return $field;
                    });
                } else {
                    $data['searchable_fields'] = [];
                }
            }
        }


        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        // location
        if ($request->has('lat') && $request->has('long') && $request->lat != null && $request->long != null) {
            $ids = $this->location_filter($request->lat, $request->long);

            $query->whereIn('id', $ids);
        }


        if ($request->has('minPrice') && $request->minPrice != null) {
            $query->where('price', '>=', $request->minPrice);
        }
        if ($request->has('maxPrice') && $request->maxPrice != null) {
            $query->where('price', '<=', $request->maxPrice);
        }


        if (isset($request->sortinput)) {
            if ($request->sortinput == "default") {
                $query->orderBy('id', 'ASC');
            } elseif ($request->sortinput == "new") {
                $query->orderBy('created_at', 'DESC');
            } elseif ($request->sortinput == "highPrice") {
                $query->orderBy('price', 'DESC');
            } elseif ($request->sortinput == "trending") {
                $query->orderBy('price', 'ASC');
            } elseif ($request->sortinput == "trending") {
                $query->where('trending', true);
            } elseif ($request->sortinput == "popular") {
                $query->where('popular', true);
            }
        }

        if (isset($request->conditions)) {
            $query->whereIn('condition', $request->conditions);
        }
        if (isset($request->country)) {
            $query->whereIn('country', $request->country);
        }


        if (isset($request->size)) {
            $size           = clone $query;
            $data['sizes'] = $size->select('category_id', 'subcategory_id', 'size_id')
                ->groupBy('size_id')
                ->get();

            $query->whereIn('size_id', $request->size);
        }

        $recent_ads =  $query->where('user_id', $user->id)->paginate(request('per_page', 15))->withQueryString();

        $total_active_ad = Ad::where('user_id', $user->id)->activeCategory()->active()->count();
        $social_medias = $user->socialMedia;


        $userFollower = UserFollower::where('seller_id', $user->id)->count();


        $asFollower = UserFollower::where('follower_id', auth()->id())->where('seller_id', $user->id)->first();

        if (isset($asFollower)) {
            $isFoollwer = true;
        } else {
            $isFoollwer = false;
        }

        return view('frontend.seller.dashboard', compact('recent_ads', 'user', 'rating_details', 'total_active_ad', 'social_medias', 'reviews', 'userFollower', 'isFoollwer'));
    }



    public function sellerFollow(User $user, $status)
    {
        $userFollower = UserFollower::where('follower_id', auth()->id())->where('seller_id', $user->id)->first();

        if (isset($userFollower) && $status == "unfollow") {
            $userFollower->delete();
        }

        if (!isset($userFollower) && $status == "follow") {
            $newUserFollower = new UserFollower();
            $newUserFollower->seller_id = $user->id;
            $newUserFollower->follower_id = auth()->id();
            $newUserFollower->save();
        }
        return redirect()->back()->with('success', 'Seller ' . $status . ' successfull');
    }

    public function rateReview(Request $request)
    {



        $request->validate([
            'stars' => 'required|numeric|between:1,5',
            'comment' => 'required|string|max:255',
        ]);

        Review::create([
            'item_id' => $request->item_id,
            'order_id' => $request->order_id,
            'stars' => $request->stars,
            'comment' => $request->comment,
            'user_id' => auth()->id(),
            'fastShipper' => $request->fastShipper ? true : false,
            'itemAsDescribed' => $request->itemAsDescribed ? true : false,
            'quickReplies' => $request->quickReplies ? true : false,
        ]);

        return redirect()->back()->with('success', 'Review submited successfully');
    }

    public function preSignup(Request $request)
    {
        session(['seller_tab' => 'review_store']);

        $request->validate([
            'email' => 'required',
        ]);

        return redirect()->route('frontend.signup', ['email' => $request->email]);
    }

    public function report(Request $request)
    {

        if (!$request->has('reason')) {
            return redirect()->back()->with('error', 'Reason field is required');
        }

        Report::create([
            'report_from_id' => auth('user')->id(),
            'report_to_id' => $request->user_id,
            'reason' => $request->reason,
            'commends' => $request->note,
        ]);

        return redirect()->back()->with('success', 'Your report submited successfully');
    }
}
