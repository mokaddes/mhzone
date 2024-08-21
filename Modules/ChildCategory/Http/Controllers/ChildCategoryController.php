<?php

namespace Modules\ChildCategory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Category\Entities\SubCategory;
use Modules\ChildCategory\Actions\CreateChildCategory;
use Modules\ChildCategory\Actions\DeleteChildCategory;
use Modules\ChildCategory\Actions\UpdateChildCategory;
use Modules\ChildCategory\Entities\ChildCategory;
use Modules\ChildCategory\Http\Requests\ChildCategoryRequest;

use function Sodium\compare;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $child_categories = ChildCategory::with('subcategory')->latest()->get();


        return view('childcategory::index',compact('child_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $sub_categories = SubCategory::with('category')->get();

        if ($sub_categories->count() < 1) {
            flashWarning("You don't have any active subcategory. Please create or active subcategory first.");
            return redirect()->route('module.subcategory.create');
        }
        return view('childcategory::create',compact('sub_categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(ChildCategoryRequest $request)
    {

        $find=ChildCategory::where('sub_category_id',$request->sub_category_id)->where('name',$request->name)->count();

        if($find > 0){
            flashError('This child category already exist in this subcategory');
            return back();
        }
        $subcategory = CreateChildCategory::create($request);
        $lname = $request->name;

        $data = file_get_contents(base_path('resources/lang/en.json'));
        $translations = json_decode($data, true);
        foreach ($translations as $key => $value) {
            if($key == $lname){
                //update
                $translations[$key] = $request->name;
            }else{
                //add
                $translations[$lname] = $request->name;
            }
        }

        file_put_contents(base_path('resources/lang/en.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));

        if ($subcategory) {
            flashSuccess('Child Category Added Successfully');
            return back();
        } else {
            flashError();
            return back();
        }

    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('childcategory::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(ChildCategory $childcategory)
    {
        $subcategories=SubCategory::all();
        return view('childcategory::edit',compact(['subcategories','childcategory']));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(ChildCategoryRequest $request,ChildCategory $childcategory)
    {

        $child_categorory=UpdateChildCategory::update($request,$childcategory);

        $lname = $request->name;

        $data = file_get_contents(base_path('resources/lang/en.json'));
        $translations = json_decode($data, true);
        foreach ($translations as $key => $value) {
            if($key == $lname){
                //update
                $translations[$key] = $request->name;
            }else{
                //add
                $translations[$lname] = $request->name;
            }
        }

        file_put_contents(base_path('resources/lang/en.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));

        if ($child_categorory) {
            flashSuccess('Child Category Update Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(ChildCategory $childcategory)
    {
        if ($childcategory->product->count()>0) {
            flashError('ChildCategory has product delete them first');
            return back();
        }
        $childcategory=DeleteChildCategory::delete($childcategory);

        if ($childcategory) {
            flashSuccess('Child Category Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }
}
