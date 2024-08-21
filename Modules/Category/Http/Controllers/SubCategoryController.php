<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Category\Entities\SubCategory;
use Illuminate\Contracts\Support\Renderable;
use Modules\Category\Actions\CreateSubCategory;
use Modules\Category\Actions\DeleteSubCategory;
use Modules\Category\Actions\UpdateSubCategory;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Category\Entities\MeasurementsPoint;
use Modules\Category\Http\Requests\SubCategoryFormRequest;

class SubCategoryController extends Controller
{
    use ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('subcategory.view')) {
            abort(403);
        }
        $sub_categories = SubCategory::withCount('ads')->latest()->get();
        return view('category::subcategory.index', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (!userCan('subcategory.create')) {
            abort(403);
        }

        $categories = Category::all();

        if ($categories->count() < 1) {
            flashWarning("You don't have any active category. Please create or active category first.");
            return redirect()->route('module.category.create');
        }
        // $meatusements = MeasurementsPoint::where('status', 1)->get();

        return view('category::subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @param SubCategoryFormRequest $request
     * @return Renderable
     */
    public function store(SubCategoryFormRequest $request)
    {

        if (!userCan('subcategory.create')) {
            abort(403);
        }
        $subcategory = CreateSubCategory::create($request);

        // $lname = str_replace(' ', '_', strtolower($request->name));
//        $lname = $request->name;
//        $data = file_get_contents(base_path('resources/lang/en.json'));
//           $translations = json_decode($data, true);
//           foreach ($translations as $key => $value) {
//               if($key == $lname){
//                   //update
//                   $translations[$key] = $request->name;
//               }else{
//                   //add
//                   $translations[$lname] = $request->name;
//               }
//           }
//
//        file_put_contents(base_path('resources/lang/en.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));

        if ($subcategory) {
            flashSuccess('SubCategory Added Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(SubCategory $subcategory)
    {
        if (!userCan('subcategory.update')) {
            abort(403);
        }
        $categories = Category::all();
        // $meatusements = MeasurementsPoint::where('status', 1)->get();
        return view('category::subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     * @param SubCategoryFormRequest $request
     * @param int $id
     * @return Renderable
     */
    public function update(SubCategoryFormRequest $request, SubCategory $subcategory)
    {
        if (!userCan('subcategory.update')) {
            abort(403);
        }
        $subcategory = UpdateSubCategory::update($request, $subcategory);

        // $lname = str_replace(' ', '_', strtolower($request->name));
//        $lname = $request->name;
//
//        $data = file_get_contents(base_path('resources/lang/en.json'));
//           $translations = json_decode($data, true);
//           foreach ($translations as $key => $value) {
//               if($key == $lname){
//                   //update
//                   $translations[$key] = $request->name;
//               }else{
//                   //add
//                   $translations[$lname] = $request->name;
//               }
//           }
//
//        file_put_contents(base_path('resources/lang/en.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));

        if ($subcategory) {
            flashSuccess('SubCategory Updated Successfully');
            return redirect(route('module.subcategory.index'));
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
    public function destroy(SubCategory $subcategory)
    {
        if (!userCan('subcategory.delete')) {
            abort(403);
        }


        if ($subcategory->childCategory->count()> 0) {
            flashError('Sub-Category has child category delete them first.');
            return back();
        }
        if ($subcategory->childCategory->count()> 0 && $subcategory->ads->count()> 0) {
            flashError('Sub-Category has product delete them first.');
            return back();
        }

        if ($subcategory->size->count() > 0) {
            flashError('Sub-Category has size delete them first.');
            return back();
        }

        $subcategory = DeleteSubCategory::delete($subcategory);

        if ($subcategory) {
            flashSuccess('SubCategory Deleted Successfully');
            return back();
        } else {
            flashError();
            return back();
        }
    }

    public function show(SubCategory $subcategory){
        $subcategory->loadCount('ads','category');
        $ads = $subcategory->ads;

        // return [
        //     'subcategory' => $subcategory,
        //     'ads' => $ads
        // ];

        return view('category::subcategory.show', compact('ads','subcategory'));
    }

    public function status_change(Request $request)
    {
        $product = SubCategory::findOrFail($request->id);
        $product->status = $request->status;
        $product->save();

        if ($request->status == 1) {
            return response()->json(['message' => 'Subcategory Activated Successfully']);
        } else {
            return response()->json(['message' => 'Subcategory Inactivated Successfully']);
        }
    }
}
