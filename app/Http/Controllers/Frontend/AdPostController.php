<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AdsAttr;
use App\Models\Attribute;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Modules\Ad\Entities\AdGallery;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Modules\ChildCategory\Entities\ChildCategory;

class AdPostController extends Controller
{
    // use AdCreateTrait;


    public function create()
    {
        $user = User::find(Auth::id());
        $seller_shop = $user->userShop;
        if (!isset($seller_shop)) {
            return view('front.user.create_shop');
        }
        $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
        $attributes = Attribute::active()->get();
        return view('front.user.ad-post', compact('departments', 'attributes',));
    }

    public function store(Request $request)
    {

        $settings = setting();
        $request->validate(
            [
                'title' => 'required|max:150',
                'price' => 'required',
                'category_id' => 'required',
                'department_id' => 'required',
                'qty' => 'required',
                'description' => 'required',
            ],
            [
                'title.required' => 'The title field is required.',
                'title.max' => 'The title is not more than 150 character.',
                'price.required' => 'The price field is required.',
                'category_id.required' => 'The category field is required.',
                'department_id.required' => 'The department field is required.',
                'qty.required' => 'The quantity field is required.',
                'description.required' => 'The description field is required.',
                'description.max' => 'Description is not more than 500 character.',
            ]
        );

        $slug = Str::slug($request->title);
        $data = Ad::where('slug', $slug)->first();
        if (isset($data)) {
            $id = Ad::max('id') + 1;
            $slug = $slug . '_' . $id;
        }

        $ads = new Ad();
        $ads->title = $request->title;
        $ads->slug = $slug;
        $ads->user_id = auth()->id();
        $ads->price = $request->price;
        $ads->qty = $request->qty;
        $ads->discount = $request->discount;
        $ads->price_after_discount = $request->price_after_discount;
        $ads->department_id = $request->department_id;
        $ads->category_id = $request->category_id;
        $ads->subcategory_id = $request->subcategory_id;
        $ads->description = $request->description;

        if ($request->file('thumbnail')) {
            $thumbnail = uploadResizedImage($request->thumbnail, 'addss_image', 250, 200, false);
            $ads->thumbnail = $thumbnail;
        }

        if ($settings->ads_admin_approval == 1) {
            $ads->status = 'pending';
        } else {
            $ads->status = 'active';
        }
        $ads->save();

        $images = $request->file('images');
        if ($images) {
            foreach ($images as $key => $image) {
                $url = uploadResizedImage($image, 'adds_multiple', 400, 350, false);
                $ads->galleries()->create(['image' => $url, 'ad_id' => $ads->id]);
            }
        }
        $this->getAttr($request, $ads);

        return redirect()->route('frontend.user.myAds')->with('success', 'Post Created Successfully!');
    }

    public function edit($slug)
    {
        $ad = Ad::where('slug', $slug)->first();
        $departments = Department::where('status', 1)->orderBy('id', 'desc')->get();
        $category = Category::where('department_id', $ad->department_id)->get();
        $subCategory = SubCategory::where('category_id', $ad->category_id)->get();
        $attributes = Attribute::active()->get();
        return view('front.user.edit-post', compact('ad', 'departments', 'category', 'subCategory', 'attributes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'title' => 'required|max:150',
                'price' => 'required',
                'category_id' => 'required',
                'department_id' => 'required',
                'qty' => 'required',
                'description' => 'required',
            ],
            [
                'title.required' => 'The title field is required.',
                'title.max' => 'The title is not more than 150 character.',
                'price.required' => 'The price field is required.',
                'category_id.required' => 'The category field is required.',
                'department_id.required' => 'The department field is required.',
                'qty.required' => 'The quantity field is required.',
                'description.required' => 'The description field is required.',
                'description.max' => 'Description is not more than 500 character.',
            ]
        );

        $ads = Ad::find($id);
        $ads->title = $request->title;
        $ads->user_id = auth()->id();
        $ads->price = $request->price;
        $ads->qty = $request->qty;
        $ads->discount = $request->discount;
        $ads->price_after_discount = $request->price_after_discount;
        $ads->department_id = $request->department_id;
        $ads->category_id = $request->category_id;
        $ads->subcategory_id = $request->subcategory_id;
        $ads->description = $request->description;
        if ($request->has('status')) {
            $ads->status = $request->status;
        }
        //thumbnail upload
        $thumbnail = $request->file('thumbnail');
        if ($thumbnail) {
            if (file_exists($ads->thumbnail)) {
                unlink($ads->thumbnail);
            }
            $thumbnail_url = uploadResizedImage($thumbnail, 'addss_image', 250, 200, false);
            $ads->thumbnail = $thumbnail_url;
        }

        $ads->save();


        $images = $request->file('images');
        $old = $request->old;
        $gallery = AdGallery::where('ad_id', $ads->id)->get();
        if ($old) {
            foreach ($gallery as $value) {
                if (!in_array($value->id, $old)) {
                    $value->delete();
                }
            };
        } else {
            foreach ($gallery as $value) {
                $value->delete();
            };
        }
        if ($images) {
            foreach ($images as $key => $image) {
                if ($image->isValid()) {
                    $url = uploadResizedImage($image, 'adds_multiple', 400, 350, false);
                    $ads->galleries()->create(['image' => $url, 'ad_id' => $ads->id]);
                }
            }
        }
        if (isset($ads->attrs) && $ads->attrs->count() > 0) {
            foreach ($ads->attrs as $item) {
                $item->delete();
            }
        }
        $this->getAttr($request, $ads);

        return redirect()->route('frontend.user.myAds')->with('success', 'Post Updated Successfully!');
    }

    public function deletePost($id)
    {
        $ad = Ad::find($id);
        $ad->delete();
        return redirect()->back()->with('success', 'Post Deleted Successfully!');
    }

    public function getCategory(Request $request)
    {
        $categories = Category::where('department_id', $request->department_id)->get();
        $html = '<option value="" class="d-none">Select Category</option>';
        foreach ($categories as $category) {
            $html .= '<option value="' . $category->id . '">' . $category->name . '</option>';
        }

        return response()->json($html);
    }

    public function getSubcategory(Request $request)
    {

        $sub_categories = SubCategory::where('category_id', $request->category_id)->get();
        $html = '<option value="" class="d-nonde">Select Subcategory</option>';

        foreach ($sub_categories as $subCategory) {
            $html .= '<option value="' . $subCategory->id . '">' . $subCategory->name . '</option>';
        }
        return response()->json($html);
    }


    public function getChildcategory(Request $request)
    {

        $childCategory = ChildCategory::where('sub_category_id', $request->id)->get();
        // return response()->json($childCategory);
        $html = '';
        foreach ($childCategory as $key => $item) {
            $scat = str_replace(' ', '_', strtolower($item->name));
            $html .= '<option value="' . $item->id . '"> ' . __($scat) . ' </option>';
        }
        return response()->json($html);
        // echo json_encode(ChildCategory::where('sub_category_id', $request->id)->get());
    }

    /**
     * @param Request $request
     * @param Ad $ads
     * @return void
     */
    public function getAttr(Request $request, Ad $ads): void
    {
        $attributes = Attribute::active()->get();
        $attr = [];

        foreach ($attributes as $k => $attribute) {
            if (!empty($request->attr_name[$attribute->id]) && !empty($request->attr_price[$attribute->id])) {
                $attrName = $request->attr_name[$attribute->id];
                $attrPrice = $request->attr_price[$attribute->id];

                foreach ($attrName as $index => $name) {
                    if (!empty($name)) {
                        $price = $attrPrice[$index] ?? 0;
                        $attr[$attribute->id][$name] = $price;
                    }
                }
                if (!empty($attr[$attribute->id])) {
                    $ads_attr = new AdsAttr();
                    $ads_attr->ad_id = $ads->id;
                    $ads_attr->attr_id = $attribute->id;
                    $ads_attr->attr_details = json_encode($attr[$attribute->id], true);
                    $ads_attr->status = 1;
                    $ads_attr->save();
                }
            }
        }
    }
}
