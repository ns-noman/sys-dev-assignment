<?php

namespace App\Http\Controllers;

use App\Models\CheckList;
use App\Models\BasicInfo;
use Illuminate\Http\Request;

class CheckListController extends Controller
{
    public function index()
    {
        return view('admin.checklist.index');
    }

    public function showTable()
    {
        return response()->json(CheckList::orderBy('id','desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $description = $request->description;
        $remarks = $request->remarks;
        for($i=0;$i<count($description);$i++){
            $data = ['description'=>$description[$i],'remarks'=>$remarks[$i]];
            CheckList::create($data);
        }
        return response()->json(['message'=>'Data Inserted Successfully!'], 200);
    }
    public function checklistsSearch(Request $request)
    {
        $result = CheckList::where('description','like','%'. $request->search .'%')->orWhere('remarks','like','%'. $request->search .'%')->get();
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function show(CheckList $checkList)
    {
        $checkList = CheckList::get();
        $basiscData = BasicInfo::first();
        return view('admin.checklist.report', compact('checkList', 'basiscData'));
    }
    public function searchView()
    {
        return view('admin.checklist.search');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkList = CheckList::find($id);
        return view('admin.checklist.edit', compact('checkList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        CheckList::find($id)->update($data = ['description'=>$request->description,'remarks'=>$request->remarks]);
        return redirect('checklists');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckList  $checkList
     * @return \Illuminate\Http\Response
     */
    public function destroy($checkList)
    {
        CheckList::destroy($checkList);
        return response()->json(['message'=>'Data Deleted Successfully!'],200);
    }
}
