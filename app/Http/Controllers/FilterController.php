<?php

namespace App\Http\Controllers;

use App\Models\Admin\ShipingLocations;
use App\Models\AdsSize;
use Google\Service\CloudSearch\Id;
use Modules\Category\Entities\SubCategory;
use Modules\CustomField\Entities\CustomField;
use Modules\CustomField\Entities\CustomFieldValue;
use Illuminate\Support\Str;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Category\Entities\Category;

class FilterController extends Controller
{
    /**
     * Search & filter post by keyword, category
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request, $rcategory = null, $subcat = null)
    {

        # code...

        $query = Ad::active()->validate()->select(
            'id',
            'title',
            'slug',
            'user_id',
            'brand_id',
            'category_id',
            'subcategory_id',
            'child_category_id',
            'price',
            'thumbnail',
            'country',
            'created_at',
            'size_id',
            'is_smart_price',
            'smart_price',
            'condition',
            'status',
        )
            ->activeCategory()
            ->with(['category:id,name,slug','subcategory:id,name,slug', 'childcategory:id,name,slug', 'adSize:id,category_id,size']);
            // dd($query->count());



        // $inputFields = [];
        // if (request()->filled('cf')) {
        //     $inputFields = request()->get('cf');
        // }

        // foreach ($inputFields as $fieldId => $postValue) {
        //     $field = CustomField::find($fieldId);
        //     if (empty($field)) {
        //         continue;
        //     }

        //     if (!is_array($postValue)) {
        //         // Other fields
        //         if (trim($postValue) == '') {
        //             continue;
        //         }

        //         $query->whereHas('productCustomFields', function ($query) use ($field, $postValue) {
        //             $query->where('custom_field_id', $field->id)->where('value', 'LIKE', "%$postValue%");
        //         });
        //     } else {
        //         foreach ($postValue as $optionValue) {

        //             if (is_array($optionValue)) continue;
        //             if (!is_array($optionValue) && trim($optionValue) == '') continue;

        //             $query->whereHas('productCustomFields', function ($query) use ($field, $optionValue) {
        //                 $query->where('custom_field_id', $field->id)->where('value', 'LIKE', "%$optionValue%");
        //             });
        //         }
        //     }
        // }


        if (isset($rcategory) && $rcategory != null) {
            $query->whereHas('category', function ($q) use ($rcategory) {
                $q->where('slug', $rcategory);
            });
        }
        // dd($query->count());



        if (isset($subcat) && $subcat != null) {
            $query->whereHas('subcategory', function ($q) use ($subcat) {
                $q->where('slug', [$subcat]);
            });
        }

        if ($request->has('childcategory') && $request->childcategory != null) {
            $childcategory = $request->childcategory;

            $query->whereHas('childcategory', function ($q) use ($childcategory) {

                $q->whereIn('slug', $childcategory);
            });
        }





        // if (isset($rcategory) || isset($subcat)) {
        //     if ($rcategory) {
        //         $category = Category::where('slug', $rcategory)->first();

        //         if ($category) {
        //             $data['searchable_fields'] = $category->customFields->where('filterable', 1)->map(function ($field) {
        //                 $field->values = CustomFieldValue::where('custom_field_id', $field->id)->get();
        //                 return $field;
        //             });
        //         } else {
        //             $data['searchable_fields'] = [];
        //         }
        //     } else {
        //         $category = SubCategory::where('slug', $subcat)->first();


        //         if ($category) {
        //             $category = $category->category;
        //             $data['searchable_fields'] = $category->customFields->where('filterable', 1)->map(function ($field) {
        //                 $field->values = CustomFieldValue::where('custom_field_id', $field->id)->get();
        //                 return $field;
        //             });
        //         } else {
        //             $data['searchable_fields'] = [];
        //         }
        //     }
        // }


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
                $query->orderBy('id', 'asc');
            } elseif ($request->sortinput == "new") {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sortinput === "highPrice") {

                $query->orderBy('price', 'desc');
            } elseif ($request->sortinput === "lowPrice") {

                $query->orderBy('price', 'asc');
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

        $data['adlistings'] =  $query->paginate(request('per_page', 15))->withQueryString();


        // return $data;
        $data['categories'] = Category::active()->with('subcategories', function ($q) {
            $q->with('childCategory', function ($quary) {
                $quary->with('product')->where('status', 1)->orderBy('name', 'ASC');
            })->where('status', 1)->orderBy('name', 'ASC');
        })->orderBy('id', 'ASC')->get();


        $data['adMaxPrice'] = DB::table('ads')->max('price');
        $data['sizes'] = DB::table('ads_sizes')->where('status', 1)->get();

        $data['shipingLocations'] = ShipingLocations::with('products')->where('status', true)->get();

        return view('frontend.ad-list', $data);
    }

    public function location_filter($latitude, $longitude)
    {
        // $latitude = -58.7699;
        // $longitude = 40.283499;
        $distance = 50;

        $haversine = "(
                    6371 * acos(
                        cos(radians(" . $latitude . "))
                        * cos(radians(`lat`))
                        * cos(radians(`long`) - radians(" . $longitude . "))
                        + sin(radians(" . $latitude . ")) * sin(radians(`lat`))
                    )
                )";

        $data = Ad::select('id')->selectRaw("$haversine AS distance")
            ->having("distance", "<=", $distance)->get();

        $ids = [];

        foreach ($data as $id) {
            array_push($ids, $id->id);
        }

        return $ids;
    }
}
