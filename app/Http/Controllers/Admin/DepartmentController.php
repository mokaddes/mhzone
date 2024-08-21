<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('id', 'desc')->paginate(30);

        return view('admin.department.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);

        $slug = Str::slug($request->name);
        $data = Department::where('slug', $slug)->first();
        if (isset($data)) {
            $id = Department::max('id') + 1;
            $slug = $slug . '_' . $id ;
        }


        $department = new Department();
        $department->name = $request->name;
        $department->slug = $slug;
        $department->status = $request->status;
        $department->save();
        return redirect()->route('department.index')->with('success', 'Department Save successfully!');
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin.department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
        ]);


        $department = Department::find($id);
        $department->name = $request->name;
        $department->slug = Str::slug($request->name);
        $department->status = $request->status;
        $department->save();
        return redirect()->route('department.index')->with('success', 'Department Upadte successfully!');
    }

    public function delete($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->route('department.index')->with('success', 'Department Deleted successfully!');
    }

    // public function status(Request $request)
    // {

    //     $id = $request->id;
    //     $status = $request->status;
    //     $department = Department::find($id);
    //     $department->status = $status;
    //     $department->save();

    //     return response()->json(['message' => 'Status Updated successfully']);
    // }

}
