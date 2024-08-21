<?php

namespace Modules\Category\Actions;

use Modules\Category\Entities\SubCategory;

class CreateSubCategory
{
    public static function create($request)
    {
//        if($request->measurements) {
//            $measurements = implode(',',$request->measurements);
//        }else {
//            $measurements = null;
//        }

        $subCategory=new SubCategory();
        $subCategory->category_id=$request->category_id;
        $subCategory->name=$request->name;
//        $subCategory->mesurement_point= $measurements;
        $subCategory->status=true;
        $subCategory->is_show_home=$request->is_show_home ? true : false;
        if($request->hasFile('image')){

            $subCategory->thumb=uploadImage($request->image, 'subcategory');
        }
        $subCategory->save();
        return $subCategory;
    }
}
