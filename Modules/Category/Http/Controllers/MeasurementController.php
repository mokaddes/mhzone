<?php

namespace Modules\Category\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Category\Entities\MeasurementsPoint;
use Modules\Category\Entities\SubCategory;

class MeasurementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $measurements = MeasurementsPoint::all();
        return view('category::measurements.index', compact('measurements'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('category::measurements.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:measurements_points,name',
        ]);

        $measurement = new MeasurementsPoint();
        $measurement->name = str_replace(' ', '_', $request->name);
        $measurement->status =  $request->status;
        $measurement->save();

        flashSuccess('Data Added Successfully');
            return redirect()->route('module.measurement.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
    
        return view('category::measurements.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(MeasurementsPoint $measurement)
    {
        return view('category::measurements.edit', compact('measurement'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, MeasurementsPoint $measurement)
    {
        $request->validate([
            'name' => 'required|unique:measurements_points,name,'.$measurement->id,
        ]);

        $measurement->name = str_replace(' ', '_', $request->name);
        $measurement->status =  $request->status;
        $measurement->save();

        flashSuccess('Data Update Successfully');
        return redirect()->route('module.measurement.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
