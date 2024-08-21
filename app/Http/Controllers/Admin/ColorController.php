<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;


class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = Color::paginate(10);
        return view('admin.color.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create');
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
            'color' => 'required|unique:colors,color'
        ]);

        $color = new Color();
        $color->color = $request->color;
        $color->status = true;
        $color->save();

        return redirect()->route('color.index')->with('success', 'Color save successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  obj  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('admin.color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $request->validate([
            'color' => 'required|unique:colors,color,' . $color->id
        ]);


        $color->color = $request->color;
        $color->status = true;
        $color->save();

        return redirect()->route('color.index')->with('success', 'Color update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  obj  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->route('color.index')->with('success', 'Color delete successfully!');
    }


    public function statusChange(Request $request)
    {

        $id = $request->id;
        $status = $request->status;
        $color = Color::find($id);
        $color->status = $status;
        $color->save();

        return response()->json(['message' => 'Updated successfully']);
    }
}
