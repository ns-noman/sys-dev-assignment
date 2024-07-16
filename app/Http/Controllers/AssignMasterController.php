<?php

namespace App\Http\Controllers;

use App\Models\AssignMaster;
use App\Models\MasterDetails;
use App\Models\Department;
use App\Models\CheckList;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;

class AssignMasterController extends Controller
{
    public function index()
    {
        $department = Department::get();
        $checkList = CheckList::get();
        return view('admin.assignmaster.index', compact('department','checkList'));
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $departmentID = array_unique($request->departmentID);
        $checklistID = $request->checklistID;
        foreach($departmentID as $key=> $deptID){
            $isExist = AssignMaster::where(['deptID'=> $deptID])->first();
            if(!$isExist){
                AssignMaster::create(['deptID'=> $deptID]);
            }
        }

        $departmentID = $request->departmentID;

        foreach($departmentID as $key=> $deptID){
            $assignMaster = AssignMaster::where(['deptID'=> $deptID])->first();

            $isExist = MasterDetails::where(['masterID'=> $assignMaster->id])->where(['checkListID'=>$checklistID[$key]])->first();
            if(!$isExist){
                $data = 
                [
                    'masterID'=>$assignMaster->id,
                    'checkListID'=>$checklistID[$key],
                ];
                MasterDetails::create($data);
            }
        }
        return response()->json(['message'=>'Data Inserted Successfully!'], 200);
    }

    public function show(AssignMaster $assignMaster)
    {
        //
    }
    public function showTable($depID)
    {
        $data = AssignMaster::join('departments','departments.id','=','assign_masters.deptID')
                ->join('master_details','master_details.masterID','=','assign_masters.id')
                ->join('check_lists','check_lists.id','=','master_details.checkListID')
                ->when($depID, function($query, $depID){
                    $query->where('assign_masters.deptID','=', $depID)->get();
                })
                ->select('departments.name', 'master_details.id', 'check_lists.description')
                ->orderBy('deptID','asc')
                ->get();
                
        return response()->json($data);
    }

    public function edit(AssignMaster $assignMaster)
    {
        //
    }

    public function update(Request $request, AssignMaster $assignMaster)
    {
        //
    }
    
    public function destroy($id)
    {
        MasterDetails::destroy($id);
        return response()->json(['message'=>'Data Deleted Successfully!'],200);
    }
}
