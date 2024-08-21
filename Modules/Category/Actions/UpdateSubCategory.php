<?php

namespace Modules\Category\Actions;

class UpdateSubCategory
{
    public static function update($request, $subcategory)
    {
//        if($request->measurements) {
//            $measurements = implode(',',$request->measurements);
//        }else {
//            $measurements = null;
//        }

        $subcategory->category_id=$request->category_id;
        $subcategory->name=$request->name;
//        $subcategory->mesurement_point= $measurements;
        $subcategory->status=true;
        $subcategory->is_show_home=$request->is_show_home ? true : false;
        if($request->hasFile('image')){

            $subcategory->thumb=uploadImage($request->image, 'subcategory');
        }
        $subcategory->save();
        return $subcategory;

    }
}
