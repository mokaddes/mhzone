<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdsSize;
use Google\Service\AdExchangeBuyerII\AdSize;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adSizes = AdsSize::with('category', 'subCategory', 'childCategory')->paginate(30);

        return view('admin.size.index', compact('adSizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.size.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',

            'size' => 'required',
        ]);

        $adSizes = new AdsSize();
        $adSizes->category_id = $request->category_id;
        $adSizes->sub_category_id = $request->subcategory_id;
        $adSizes->size = $request->size;
        $adSizes->status = true;
        $adSizes->save();
        return redirect()->route('size.index')->with('success', 'Size Save successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdsSize $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AdsSize $size)
    {
        return view('admin.size.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdsSize $adSizes)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'size' => 'required',
        ]);


        $adSizes->category_id = $request->category_id;
        $adSizes->sub_category_id = $request->subcategory_id;
        $adSizes->size = $request->size;
        $adSizes->status = true;
        $adSizes->save();
        return redirect()->route('size.index')->with('success', 'Size Upadte successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdsSize $size)
    {

        if (isset($size->ads) && $size->ads->count()) {
            return redirect()->route('size.index')->with('error', 'Size has Product delete them first');
        }
        $size->delete();
        return redirect()->route('size.index')->with('success', 'Size Delete successfully!');
    }

    public function getSizeByCategories(Request $request)
    {

        $sizes = AdsSize::where('sub_category_id', $request->subCategory)
            ->where('status', true)->get();

        return response()->json($sizes);
    }


    public function statusChange(Request $request)
    {

        $id = $request->id;
        $status = $request->status;
        $adSizes = AdsSize::find($id);
        $adSizes->status = $status;
        $adSizes->save();

        return response()->json(['message' => 'Updated successfully']);
    }
}
