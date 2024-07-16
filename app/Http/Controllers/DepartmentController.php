<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class DepartmentController extends Controller
{
    public function __construct(){
        // dd(Route::currentRouteName());
    }

    public function index()
    {
        return view('admin.departments.index');
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $name = $request->name;
        for($i=0;$i<count($name);$i++){
            $data = ['name'=>$name[$i]];
            Department::create($data);
        }
        return response()->json(['message'=>'Data Inserted Successfully!'], 200);
    }

    public function show(Department $department)
    {
        //
    }

    public function deptData()
    {
        return response()->json(Department::orderBy('id','desc')->get());
    }

    public function edit(Department $department)
    {
        //
    }

    public function update(Request $request, Department $department)
    {
        //
    }

    public function destroy($id)
    {
        Department::destroy($id);
        return response()->json(['message'=>'Data Deleted Successfully!'],200);
    }
}
