<?php

namespace Modules\Category\Http\Controllers;


use Stripe\Product;
use App\Models\Department;
use Modules\Ad\Entities\Ad;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Illuminate\Contracts\Support\Response;
use Modules\Category\Entities\SubCategory;
use Modules\Category\Actions\UpdateCategory;
use Modules\Category\Actions\SortingCategory;
use Modules\CustomField\Entities\CustomField;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Modules\Category\Http\Requests\CategoryFormRequest;
use Modules\Category\Repositories\CategoryRepositories;

class CategoryController extends Controller
{
    use ValidatesRequests;

    protected $category;

    public function __construct(CategoryRepositories $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the categories.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!userCan('category.view')) {
            return abort(403);
        }
        $categories = Category::withCount('ads', 'customFields')->oldest('order')->paginate(10);

        return view('category::category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!userCan('category.create')) {
            return abort(403);
        }
        $departments = Department::orderBy('id', 'desc')->get();
        return view('category::category.create', compact('departments'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param CategoryFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryFormRequest $request)
    {
        if (!userCan('category.create')) {
            return abort(403);
        }

        try {

            $this->category->store($request);
            // $cat_name = $request->name;
            // $department_id = $request->department_id;
            // $request['lname'] = $cat_name;

            // $data = file_get_contents(base_path('resources/lang/en.json'));
            // $translations = json_decode($data, true);
            // foreach ($translations as $key => $value) {
            //     if($key == $cat_name){
            //         //update
            //         $translations[$key] = $request->name;
            //     }else{
            //         //add
            //         $translations[$cat_name] = $request->name;
            //     }
            // }
            // file_put_contents(base_path('resources/lang/en.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));

            flashSuccess('Category Added Successfully');
            return back();
        } catch (\Throwable $th) {
            dd($th);
            flashError();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (!userCan('category.update')) {
            return abort(403);
        }
        $departments = Department::orderBy('id', 'desc')->get();
        return view('category::category.edit', compact('category', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     * @param CategoryFormRequest $request
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryFormRequest $request, Category $category)
    {
        // dd($request->all());
        if (!userCan('category.update')) {
            return abort(403);
        }

        // try {
            UpdateCategory::update($request, $category);
            // $cat_name = $request->name;
            // // $department_id = $request->department_id;
            // $request['lname'] = $cat_name;

            // $data = file_get_contents(base_path('resources/lang/en.json'));
            // $translations = json_decode($data, true);
            // foreach ($translations as $key => $value) {
            //     if($key == $cat_name){
            //         //update
            //         $translations[$key] = $request->name;
            //     }else{
            //         //add
            //         $translations[$cat_name] = $request->name;
            //     }
            // }
            // file_put_contents(base_path('resources/lang/en.json'), json_encode($translations, JSON_UNESCAPED_UNICODE));
            flashSuccess('Category Updated Successfully');
            return redirect(route('module.category.index'));
        // } catch (\Throwable $th) {
        //     flashError();
        //     return back();
        // }
    }

    /**
     * Remove the specified resource from storage.
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (!userCan('category.delete')) {
            return abort(403);
        }

        try {
            if ($category->subcategories->count() > 0) {

                flashError('Category has subcategory delete them first');
                return back();
            }

            if ($category->ads->count() > 0) {
                flashError('Category has product delete them first');
                return back();
            }

            $this->category->destroy($category);
            flashSuccess('Category Deleted Successfully');
            return back();
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function updateOrder(Request $request)
    {
        if (!userCan('category.update')) {
            return abort(403);
        }
        try {
            SortingCategory::sort($request);
            return response()->json(['message' => 'Category Sorted Successfully!']);
        } catch (\Throwable $th) {
            flashError();
            return back();
        }
    }

    /**
     * Get subcateogry by category id
     * @param int $category_id
     * @return \Illuminate\Http\Response
     */
    public function getSubcategories($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->latest()->get()->map(fn ($item) => [
            'id' => $item->id,
            'name' => $item->name,
        ]);
        return response()->json($subcategories);
    }

    public function show(Category $category)
    {
        $category->loadCount('ads', 'subcategories');
        $ads = $category->ads;
        $subcategories = $category->subcategories->loadCount('ads');

        return view('category::category.show', compact('category', 'ads', 'subcategories'));
    }

    public function status_change(Request $request)
    {
        $product = Category::findOrFail($request->id);
        $product->status = $request->status;
        $product->save();

        if ($request->status == 1) {
            return response()->json(['message' => 'Category Activated Successfully']);
        } else {
            return response()->json(['message' => 'Category Inactivated Successfully']);
        }
    }

    // public  function customField(Category $category)
    // {
    //     $fields = $category->customFields;

    //     return view('category::category.custom-field', compact('fields', 'category'));
    // }
}
