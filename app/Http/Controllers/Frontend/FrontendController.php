<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Cms;
use App\Models\User;
use App\Models\Admin;
use App\Models\Setting;
use App\Models\Customer;
use App\Models\UserShop;
use App\Models\Department;
use App\Models\HelpReason;
use App\Models\ContactHelp;
use App\Models\OrderDetail;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Modules\Faq\Entities\Faq;
use App\Models\PaymentSetting;
use Modules\Blog\Entities\Post;
use Modules\Plan\Entities\Plan;
use Illuminate\Support\Facades\DB;
use Modules\Review\Entities\Review;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Modules\Contact\Entities\Contact;
use Modules\Faq\Entities\FaqCategory;
use Modules\Blog\Entities\PostCategory;
use Modules\Category\Entities\Category;
use Modules\Wishlist\Entities\Wishlist;
use App\Notifications\OrderNotification;
use App\Notifications\LogoutNotification;
use App\Notifications\ContactNotification;
use App\Notifications\WelcomeNotification;
//use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Notification;
use Modules\Category\Entities\SubCategory;
use App\Notifications\AdWishlistNotification;
use Modules\Testimonial\Entities\Testimonial;

class FrontendController extends Controller
{
    /**
     * View Home page
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function index()
    {
        $data['recent_ads'] = Ad::active()->latest('id')->take(10)->get();
        $data['departments'] = Department::active()->get();
        $data['categories'] = Category::active()->get();
        $data['ad_banners'] = Ad::active()->where('is_banner', 1)->orderBy('id', 'desc')->get();
        $deal_of_the_day = Ad::where('is_deal_of_day', 1)->first();
        if (!isset($deal_of_the_day)) {
            $deal_of_the_day = Ad::active()->latest('id')->first();
        }
        $data['deal_of_the_day'] = $deal_of_the_day;

        return view('front.index', $data);
    }

    // public function storeReview(Request $request){

    //     $request->validate(
    //         [
    //             'stars' => 'required',
    //             'comment' => 'required|string|max:250',

    //         ],
    //         [
    //             'stars.required' => 'The stars is required!!',
    //             'comment.required' => 'The review field is required!!',
    //         ]);
    //         if(Auth::check()){
    //             if($request->order_id==Auth::user()->id){

    //                 DB::table('reviews')->insert([
    //                     'order_id' => $request->order_id,
    //                     'user_id' => Auth::user()->id,
    //                     'stars' => $request->stars,
    //                     'comment' => $request->comment,
    //                     'status' => 1,
    //                     'created_at' => Carbon::now(),
    //                     'created_by' => Auth::user()->id,
    //                 ]);
    //             }
    //         }else{
    //             return redirect()->route('user.login');
    //         }

    // }
    /**
     * @return void
     */
    public function shop(Request $request, $department = null)
    {
        $departments = Department::where('status', 1)->get();
        $cat = Category::active();
        $query = Ad::active();
        $subcategories = null;
        if ($department != null) {
            $query->whereHas('department', function ($q) use ($department) {
                $q->where('slug', $department);
            });
            $cat->whereHas('department', function ($q) use ($department) {
                $q->where('slug', $department);
            });
        }
        $this->filterQuery($request, $query);
        $categories = $cat->get();
        if ($request->has('category')) {
            $category = $request->get('category');
            $subcategories = SubCategory::whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            })->active()->get();
        }
        $ads = $query->latest()->paginate(12);
        return view('front.shop', compact('ads', 'categories', 'departments', 'subcategories'));
    }

    public function sellerShop(Request $request, $shop_slug, $department = null)
    {
        $seller_shop = UserShop::where('slug', $shop_slug)->first();
        $user = $seller_shop->user;
        if (isset($seller_shop)) {
            $query = Ad::where('user_id', $user->id);
            $departments = Department::active()->get();
            $cat = Category::active()->with('department');
            $subcategories = null;
            if ($department && $department != null) {
//                $department = $request->get('department');
                $query->whereHas('department', function ($q) use ($department) {
                    $q->where('slug', $department);
                });
                $cat->whereHas('department', function ($q) use ($department) {
                    $q->where('slug', $department);
                });
            }
            if ($request->has('category')) {
                $category = $request->get('category');
                $subcategories = SubCategory::whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                })->active()->get();
            }


            $this->filterQuery($request, $query);
            if (Auth::check() && Auth::user()->id == $user->id) {
                $ads = $query->latest()->paginate(12);
            } else {
                $ads = $query->active()->latest()->paginate(12);
            }
            $categories = $cat->get();
            return view('front.seller_shop', compact('user', 'seller_shop', 'ads', 'categories', 'departments', 'subcategories'));
        }
        return view('frontend.index');
    }


    /**
     * View Testimonial page
     *
     * @param Testimonial
     * @return \Illuminate\Http\Response
     * @return void
     */
    public function about()
    {
        $testimonials = Testimonial::latest('id')->get();
        $cms = Cms::select(['about_body', 'about_video_thumb', 'about_background', 'about_body_lt'])->first();
        return view('frontend.about', compact('testimonials', 'cms'));
    }

    /**
     * View Faq page
     *
     * @param Faq
     * @return void
     */
    public function faq()
    {
        if (!enableModule('faq')) {
            abort(404);
        }
        $category_slug = request('category') ?? FaqCategory::first()->slug;
        $category = FaqCategory::where('slug', $category_slug)->first();
        $data['categories'] = FaqCategory::latest()->get(['id', 'name', 'slug', 'icon']);
        $data['faqs'] = Faq::where('faq_category_id', $category->id)->with('faq_category:id,name,icon')->get();

        return view("frontend.faq", $data);
    }

    /**
     * View Contact page
     *
     * @return void
     */
    public function contact()
    {
        if (!enableModule('contact')) {
            abort(404);
        }
        $contactHelps = ContactHelp::all();


        return view('frontend.contact', compact('contactHelps'));
    }

    /**
     * View Single Ad page
     *
     * @return void
     */
    public function adDetails(Ad $ad)
    {
        if ($ad->status == 'pending') {
            if ($ad->user_id != auth('user')->id()) {
                abort(404);
            }
        }
        $user = User::find($ad->user_id);
        $related_ad = Ad::active()->where('user_id', $ad->user_id)->get();
        $reviews = Review::with('user')->where('ad_id', $ad->id)->orderBy('id', 'desc')->get();
        $checkReview = null;
        if (Auth::check()) {
            $checkReview = OrderDetail::where('ad_id', $ad->id)->where('buyer_id', Auth::user()->id)->first();
        }
        // dd($reviews);
        return view('front.product_details', compact('ad', 'related_ad', 'user', 'reviews', 'checkReview'));
    }

    /**
     * View ad list page
     *
     * @return void
     */
    public function adList()
    {
        $data['adlistings'] = Ad::select('id', 'title', 'slug', 'user_id', 'category_id', 'subcategory_id', 'price', 'thumbnail', 'country', 'status')
            ->activeCategory()
            ->where('validity', '>', now())
            ->with(['category:id,name', 'productCustomFields' => function ($q) {
                $q->select('id', 'ad_id', 'custom_field_id', 'value', 'order')->with(['customField' => function ($q) {
                    $q->select('id', 'name', 'type', 'icon', 'order', 'listable')
                        ->where('listable', 1)
                        ->oldest('order')
                        ->without('customFieldGroup');
                }])->latest();
            }])
            ->latest('id')
            ->active()
            ->paginate(21);
        $data['categories'] = Category::active()->with('subcategories', function ($q) {
            $q->where('status', 1);
        })->latest('id')->get();

        $data['adMaxPrice'] = $price = DB::table('ads')->max('price');

        return view('frontend.ad-list', $data);
    }

    /**
     * View Get membership page
     *
     * @return void
     */
    public function getMembership()
    {
        if (!enableModule('price_plan')) {
            abort(404);
        }

        $data['plans'] = Plan::latest()->get();
        return view('frontend.get-membership', $data);
    }

    /**
     * View Priceplan page
     *
     * @return void
     */
    public function pricePlan()
    {
        if (!enableModule('price_plan')) {
            abort(404);
        }

        $plans = Plan::all();
        return view('frontend.price-plan', compact('plans'));
    }

    /**
     * View Signup page
     *
     * @return void
     */
    public function signUp()
    {
        //        return redirect()->route('frontend.index');
        $verified_users = User::where('email_verified_at', '!=', null)->count();

        return view('front.signup', compact('verified_users'));
    }

    /**
     * Show the form for creating a new resource.
     * @param Customer
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // return redirect()->route('frontend.index');
        $setting = setting();

        //        $rules = [
        //            'name' => "required",
        //            'phone' => "required|unique:users,phone",
        //            'email' => "required|email|unique:users,email",
        //            'password' => "required|confirmed|min:8|max:50",
        //        ];
        //
        //        $validator = Validator::make($request->all(), $rules);
        ////        dd($request->all());
        //
        //        if ($validator->fails()) {
        //            if ($request->wantsJson()) {
        //                return response()->json(["error" => $validator->errors()], 200);
        //            } else {
        //                return redirect()->back()->withErrors($validator->errors());
        //            }
        //        }

        //        dd($request->all());
        $request->validate([
            'name' => "required",
            'phone' => "required|unique:users,phone",
            'email' => "required|email|unique:users,email",
            'password' => "required|confirmed|min:8|max:50",
        ], [
            'name.required' => 'The name field is required.',
            'phone.required' => 'The phone field is required.',
            'phone.unique' => 'The phone number is already exists.',
            'email.required' => 'The name field is required',
            'email.unique' => 'The email address is already exists.',
            'password.required' => 'The password field is required',
            'password.confirmed' => 'The password must be confirmed',
            'password.min' => 'The password at least 8 character length.',
            'password.max' => 'The password maximum 50 character length.',
        ]);


        $email = $request->get('email');
        list($username, $domain) = explode('@', $email);


        $created = User::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'dob' => $request->has('dob') ? Carbon::parse($request->get('dob')) : null,
            'gender' => $request->get('gender'),
            'username' => $username,
            'email' => $email,
            'password' => Hash::make($request->get('password')),
        ]);

        if ($created) {

            Auth::guard('user')->logout();
            Auth::guard('admin')->logout();
            flashSuccess('You have successfully registered.');
            Auth::guard('user')->login($created);

            $details = [
                'subject' => 'Welcome to erthoo.com',
                'greeting' => 'Hi ' . $created['name'] . ', ',
                'body' => 'You have successfully registered to ' . env('APP_NAME'),
                'email' => 'Your email is : ' . $created['email'],
                'thanks' => 'Thank you for using our erthoo.com . ',
            ];

            $admin = Admin::first();
            $admin_details = [
                'subject' => 'Register a new user',
                'greeting' => 'Hi ' . $admin->name . ', ',
                'body' => 'An user ' . $created['name'] . ' registered to ' . env('APP_NAME'),
                'email' => 'User email is : ' . $created['email'],
                'thanks' => 'Thank you for using our erthoo.com . ',
            ];

            Notification::route('mail', $created['email'])->notify(new WelcomeNotification($details));
            Notification::route('mail', $admin->email)->notify(new WelcomeNotification($admin_details));



            if ($setting->customer_email_verification == 1) {
                auth('user')->user()->sendEmailVerificationNotification();
                return redirect()->route('verification.notice');
            } else {

                $isverify = auth('user')->user();
                User::where('id', $isverify->id)->update([
                    'email_verified_at' => Carbon::now(),
                ]);

                if ($request->wantsJson()) {
                    return response()->json("success", 200);
                } else {
                    return redirect()->route('frontend.index');
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function frontendLogout()
    {
        $this->loggedoutNotification();
        auth()->guard('user')->logout();

        return redirect()->route('frontend.index');
    }

    public function loggedoutNotification()
    {

        $user = User::find(auth('user')->id());
        if (checkSetup('mail')) {
            $user->notify(new LogoutNotification($user));
        }
    }

    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function blog(Request $request)
    {
        if (!enableModule('blog')) {
            abort(404);
        }

        $query = Post::with('author')->withCount('comments');

        if ($request->has('category') && $request->category != null) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', request('category'));
            });
        }

        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        return view('frontend.blog', [
            'blogs' => $query->paginate(6),
            'recentBlogs' => Post::withCount('comments')->latest()->take(4)->get(),
            'topCategories' => PostCategory::latest()->take(6)->get(),
        ]);
    }

    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function singleBlog(Post $blog)
    {
        if (!enableModule('blog')) {
            abort(404);
        }

        $recentPost = Post::withCount('comments')->latest('id')->take(6)->get();
        $categories = PostCategory::latest()->take(6)->get();
        $blog->load('author', 'category')->loadCount('comments');

        return view('frontend.blog-single', compact('blog', 'categories', 'recentPost'));
    }

    /**
     * View Privacy Policy page
     *
     * @return void
     */
    public function privacy()
    {
        return view('frontend.privacy')->with('Cms', Cms::select(['privacy_body', 'privacy_background', 'privacy_body_lt'])->first());
    }

    /**
     * View Terms & Condition page
     *
     * @return void
     */
    public function terms()
    {
        return view('frontend.terms')->with('Cms', Cms::select(['terms_body', 'terms_background', 'terms_body_lt'])->first());
    }


    public function setSession(Request $request)
    {
        $request->session()->put('location', $request->input());
        return response()->json(true);
    }

    public function addToWishList(Request $request)
    {

        $oldwishlist = Wishlist::where('ad_id', $request->ad_id)->where('user_id', Auth::id())->first();
        if ($request->isChecked) {
            # code...
            $ad = Ad::findOrFail($request->ad_id);
            $user = auth('user')->user();
            $seller = User::findOrFail($ad->user_id);
            if (!isset($oldwishlist)) {
                $wishlist = new Wishlist();
                $wishlist->ad_id = $request->ad_id;
                $wishlist->user_id = Auth::id();
                $wishlist->save();
                if (checkSetup('mail')) {
                    $seller->notify(new AdWishlistNotification($user, 'add', $ad->slug));
                }
            }
        } else {
            if (isset($oldwishlist)) {
                $oldwishlist->delete();
            }
        }

        $countproduct = Wishlist::where('user_id', Auth::id())->count();


        if ($request->isChecked) {
            return response()->json(['message' => 'Add to wishlist successfully', 'count' => $countproduct], 200);
        } else {
            return response()->json(['message' => 'Remove from wishlist successfully', 'count' => $countproduct], 200);
        }
    }


    public function myReview(Ad $ad)
    {
        $reviews = Review::with('ads')->where('item_id', $ad->id)->get();
        return view('frontend.feedback.index', compact('reviews'));
    }


    public function contactForm(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'listing_url' => 'required',
                'help' => 'required',
                'reason' => 'required',
                'image' => 'sometimes',
                'message' => 'required',
            ]);

            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->listing_url = $request->listing_url;
            $contact->subject_id = $request->help;
            $contact->reason_id = $request->reason;
            if ($request->has('image')) {
                $contact->screenshot = uploadImage($request->image, "contantImage");
            }
            $contact->message = $request->message;
            $contact->save();
            return redirect()->back()->with('success', "Contact form submited");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function requestReason(Request $request)
    {
        $contactHelp = HelpReason::where('contact_helps_id', $request->id)->get();
        return response($contactHelp, 200);
    }

    public function mailToCustomer(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required',
        ]);

        $details = [
            'customer' => $request->customer_name,
            'user' => Auth::user()->name,
            'title' => $request->subject,
            'body' => $request->message,
        ];

        Mail::to($request->customer_email)->send(new \App\Mail\MyTestMail($details));

        return redirect()->back()->with('success', 'Mail has been sent.');
    }

    public function reactiveAd(Ad $ad)
    {
        $setting = Setting::first();
        $user = User::find($ad->user_id);
        $validity = Carbon::now()->addDays($setting->ad_valid_day);
        $ad->update(['validity' => $validity]);

        $user->coupons = $user->coupons - 1;
        $user->save();
        flashSuccess('Your ad is activated Successfully');
        return back();
    }

    public function dataDeletion()
    {
        $cms = Cms::first();
        return view('frontend.datadeletion', compact('cms'));
    }


    public function addToFavorite(Request $request)
    {
        $id = $request->id;
        $user = $request->user;
        $isExist = Wishlist::where(['ad_id' => $id, 'user_id' => $user])->first();

        if (!$isExist) {
            $wishlist = new Wishlist();
            $wishlist->ad_id = $id;
            $wishlist->user_id = $user;
            $wishlist->save();
            if ($request->ajax()) {
                $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
                return response()->json(['status' => 'success', 'message' => 'Wishlist added successfully', 'wishlistCount' => $wishlistCount]);
            }
            $notification = 'Wishlist added successfully';
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return redirect()->back()->with($notification);
        } else {
            $isExist->delete();
            if ($request->ajax()) {
                $wishlistCount = Wishlist::where('user_id', Auth::user()->id)->count();
                return response()->json(['status' => 'failed', 'message' => 'Item is removed from favorite.', 'wishlistCount' => $wishlistCount]);
            }
            $notification = 'Item already exist';
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }

    /**
     * @param Request $request
     * @param $query
     * @return void
     */
    public function filterQuery(Request $request, $query): void
    {
        if ($request->has('category')) {
            $category = $request->get('category');
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            });

            $subcategories = SubCategory::whereHas('category', function ($q) use ($category) {
                $q->where('slug', $category);
            })->active()->get();
        }
        if ($request->has('subcategory')) {
            $subcategory = $request->get('subcategory');
            $query->whereHas('subcategory', function ($q) use ($subcategory) {
                $q->whereIn('slug', $subcategory);
            });
        }
        if ($request->has('keyword') && $request->keyword != null) {
            $query->where('title', 'LIKE', "%$request->keyword%");
        }

        if ($request->has('min_price') && $request->get('min_price') != null) {
            $query->where('price', '>=', $request->get('min_price'));
        }

        if ($request->has('max_price') && $request->get('max_price') != null) {
            $query->where('price', '<=', $request->get('max_price'));
        }

        if ($request->has('sort') && $request->get('sort') != null) {
            if ($request->get('sort') == 'high_to_low') {
                $query->whereNotNull('price')->orderBy('price', 'desc');
            }
            if ($request->get('sort') == 'low_to_high') {
                $query->whereNotNull('price')->orderBy('price', 'asc');
            }
            if ($request->get('sort') == 'recent') {
                $query->latest();
            }
        }
    }


    public function helpCenter()
    {
        $faqs = Faq::orderBy('id', 'asc')->get();
        return view('front.help_center', compact('faqs'));
    }


    public function storeContact(Request $request)
    {

        $request->validate(
            [
                'name' => 'required|max:120',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required|max:250',
            ],
            [
                'name.required' => 'The Name field is required.',
                'email.required' => 'The Email filed is required!.',
                'email.email' => 'The Email filed must be an email.',
                'subject.required' => 'The Subject is required',
                'message.required' => 'The Message Filed is required.',
            ]
        );

        $contact = new Contact();
        $contact->name      = $request->name;
        $contact->email     = $request->email;
        $contact->subject   = $request->subject;
        $contact->message   = $request->message;
        $contact->save();
        $admin = Admin::first();
        $details = [
            'subject' => 'A contact request is sent by user.',
            'greeting' => 'Hi '. $admin->name,
            'body' => 'A contact message is sent by an user. Here is the details:',
            'name' => 'Name: ' . $contact->name,
            'email' => 'Email: ' . $contact->email,
            'sub' => 'Email: ' . $contact->subject,
            'message' => 'Message: ' . $contact->message,
            'thanks' => 'Thank you to stay with '. env('APP_NAME'),
        ];
        Notification::route('mail', $admin->email)->notify(new ContactNotification($details));
        return redirect()->back()->with('success', 'Thank you! Your request has been sent.');
    }


    public function privacyPolicy(){

        $cms =  Cms::first();
        return view('front.privacy_policy', compact('cms'));
    }

    public function termsCondition(){
        $cms =  Cms::first();
        return view('front.terms_condition', compact('cms'));
    }

    public function aboutUs(){
        $cms =  Cms::first();
        return view('front.about', compact('cms'));
    }
}
