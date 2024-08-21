<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Response;
use App\Models\Cms;
use App\Models\ContactHelp;
use App\Models\HelpReason;
use App\Models\Setting;
use App\Models\User;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use Modules\Faq\Entities\Faq;
use Modules\Plan\Entities\Plan;
use Modules\Brand\Entities\Brand;
use Modules\Contact\Entities\Contact;
use Modules\Faq\Entities\FaqCategory;
use Illuminate\Support\Facades\Validator;
use Modules\Coupon\Entities\Coupon;
use Modules\Testimonial\Entities\Testimonial;


class AppController extends Response
{
    public function testimonialList()
    {

        $testimonial = Testimonial::latest('id')->get();
        return parent::sendResponse(200, "testimonial", $testimonial);
    }

    // public function cities(Request $request)
    // {
    //     $paginate = $request->paginate ?? false;

    //     if ($paginate) {
    //         $city = City::withCount('ads')->latest('ads_count')->simplePaginate($paginate);
    //         return parent::sendResponse(200, "City", $city);
    //     } else {
    //         $city = City::withCount('ads')->latest('ads_count')->get();
    //         return parent::sendResponse(200, "City", $city);
    //     }

    //     $cities = City::latest()->paginate(10);

    //     return response()->json($cities);
    // }

    // public function citiesTowns(City $city)
    // {
    //     $towns = $city->towns()->get();

    //     return TownResource::collection($towns);
    // }

    public function ContactHelp(Request $request)
    {
        $contactHelps = ContactHelp::all();
        $message = 'Contact Help';
        return parent::sendResponse(200, $message, $contactHelps);
    }

    public function requestReason(Request $request)
    {
        $contactHelp = HelpReason::where('contact_helps_id', $request->id)->get();
        $message = 'Contact Help Reason';

        return parent::sendResponse(200, $message, $contactHelp);
    }

    public function contactMessage(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'listing_url' => 'required',
            'help' => 'required',
            'reason' => 'required',
            'image' => 'sometimes',
            'message' => 'required',
        ]);

        if ($validate->fails()) {

            return parent::sendError("Validation Error", $validate->errors()->first());
            # code...
        }

        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->listing_url = $request->listing_url;
        $contact->subject_id = $request->help;
        $contact->reason_id = $request->reason;
        if ($request->has('image')) {
            $contact->screenshot = parent::uploadBase64FileToPublic($request->image, "contantImage");
        }
        $contact->message = $request->message;
        $contact->save();

        if ($contact) {
            $message = 'Message Send Successfully';
            return parent::sendResponse(200, $message, []);
        } else {
            $message = 'Something Wrong';
            return parent::sendError("Exception Error", $message, []);
        }
    }

    public function faqsCategory()
    {
        $faqs_categories = FaqCategory::latest()->get();

        return parent::sendResponse(200, 'Faq Categories', $faqs_categories);
    }

    public function categoriesFaq(FaqCategory $category)
    {
        $faqs = Faq::where('faq_category_id', $category->id)->latest()->get();

        return parent::sendResponse(200, 'Faq', $faqs);
    }

    public function contactContent()
    {
        $contactData = Setting::select('phone', 'email', 'address')->first();

        return parent::sendResponse(200, "Contact Data", $contactData);
    }

    // public function postingrulesContent()
    // {

    //     $posting_rules = Cms::select("posting_rules_background", "posting_rules_body")->first();

    //     if ($posting_rules) {

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Data fetch success',
    //             'data' => $posting_rules,

    //         ], Response::HTTP_OK);
    //     } else {

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Something went wrong'
    //         ], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    public function aboutContent()
    {
        $about = Cms::select("about_video_thumb", "about_background", "about_body")->first();

        $verified_users = User::where('email_verified_at', '!=', null)->count();
        $published_ads = Ad::activeCategory()->active()->count();

        $data = [
            'about_content' => $about,
            'published_ads_count' => $published_ads,
            'verified_users_count' => $verified_users,
        ];

        return parent::sendResponse(200, 'About Us Content', $data);
    }

    public function brands()
    {
        $brands = Brand::latest()->get();
        return parent::sendResponse(200, 'Brands', $brands);
    }

    public function planList()
    {
        $plans =  Coupon::where('status', 1)->get();

        return parent::sendResponse(200, 'Plans', $plans);
    }

    // public function generateToken(Request $request)
    // {
    //     try {
    //         auth('api')->user()->update(['fcm_token' => $request->token]);

    //         return response()->json([
    //             'token' => $request->token,
    //             'message' => 'Token Generated Successfully',
    //             'user' => auth('api')->user(),
    //             'success' => true
    //         ]);
    //     } catch (\Exception $e) {
    //         report($e);
    //         return response()->json([
    //             'success' => false
    //         ], 500);
    //     }
    // }
}
