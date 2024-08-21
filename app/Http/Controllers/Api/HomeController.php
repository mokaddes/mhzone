<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\RecentViewAd;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Transformers\AdResource;
use Modules\Blog\Entities\Post;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Category\Transformers\CategoryResource;
use Modules\Currency\Entities\Currency as EntitiesCurrency;


class HomeController extends Response
{
    /**
     * View Home page
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function index()
    {
        $data = [];
        $topCategories = CategoryResource::collection(Category::active()->with('subcategories', function ($q) {
            $q->with('childCategory')->where('status', 1);
        })->withCount('ads as ad_count')->where('status', '!=', 'pending')->latest('ad_count')->take(6)->get());

        $data['topCategories'] = $topCategories;

        $data['topCountry'] = DB::table('ads')
            ->select('country', DB::raw('count(*) as total'))
            ->orderBy('total', 'desc')
            ->groupBy('country')
            ->limit(6)
            ->get();

        $data['totalAds'] = Ad::activeCategory()->where('status', '!=', 'pending')->active()->count();

        return $this->homePage1($data);
    }


    /**
     * Return homapge 1 layouts views
     *
     * @param array $data
     *
     * @return View
     */
    public function homePage1($data)
    {
        $ad_data = Ad::activeCategory()->where('status', '!=', 'pending')->where('validity', '>', now())->with(['adFeatures', 'customer', 'category:id,name,icon', 'productCustomFields' => function ($q) {
            $q->select('id', 'ad_id', 'custom_field_id', 'value', 'order')->with(['customField' => function ($q) {
                $q->select('id', 'name', 'type', 'icon', 'order', 'listable')
                    ->where('listable', 1)
                    ->oldest('order')
                    ->without('customFieldGroup');
            }])->latest();
        }]);

        $ads = AdResource::collection($ad_data->get());
        $categories = CategoryResource::collection(Category::active()->with('subcategories', function ($q) {
            $q->where('status', 1);
        })->get());
        $recommendedAds = $ad_data->where('featured', true)->take(12)->latest()->get();

        $latestAds = AdResource::collection(Ad::activeCategory()->with(['customer', 'category:id,name,icon'])->where('featured', '!=', 1)->where('status', 'active')->validate()->take(12)->latest()->get());
        $recentVirews = RecentViewAd::with('ads')->where('session_id', Session::getId())->get();

        if (count($recentVirews) >= 6) {

            $data['recentVirews'] = $recentVirews->take(6);
        } else {
            $data['recentVirews'] = null;
        }

        $data['ads'] = collectionToResource($ads);
        $data['categories'] = $categories;
        $data['categoriesviews'] = $categories->take(2);
        $data['staff_picks'] = $ads->where('tags', 'staff_picks');

        $data['trending_streetwears'] = $ads->where('tags', 'trending_streetwear');

        $data['recommendedAds'] = collectionToResource($recommendedAds);
        $data['latestAds'] = collectionToResource($latestAds);

        $data['verified_users'] = User::whereNotNull('email_verified_at')->count();

        $countryCount =  DB::table('ads')
            ->select('country', DB::raw('count(*) as total'))
            ->groupBy('country')
            ->get();
        $data['country_location'] = $countryCount->count();

        $data['pro_members_count'] = User::whereHas('userPlan', function ($q) {
            $q->where('badge', true);
        })->count();

        $data['sliders'] = Slider::where('status', true)->limit(6)->get();
        $data['setting'] = Setting::first();
        $data['currencies'] = EntitiesCurrency::first();
        $data['deals'] = $ads->where('price', '<', $data['setting']->deals_under_price);
        $data['blogs'] = Post::orderBy('id', 'desc')->take(3)->get();


        return parent::sendResponse(200, "Home Page", $data, true, null);
    }
}
