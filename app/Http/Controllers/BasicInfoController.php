<?php

namespace App\Http\Controllers;

use App\Models\BasicInfo;
use Illuminate\Http\Request;
use Auth;
use File;
class BasicInfoController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function index()
    {
        $basicInfo = BasicInfo::where('companyID', $this->user->companyid)->first();
        return view('admin.basic-infos.index', compact('basicInfo'));
    }

    public function edit(BasicInfo $basicInfo)
    {
        return view('admin.basic-infos.edit', compact('basicInfo'));
    }

    public function update(Request $request, BasicInfo $basicInfo)
    {
        $data = $request->all();
        if(isset($data['logo'])){
            $fileName = 'logo-'. time().'.'. $data['logo']->getClientOriginalExtension();
            $data['logo']->move(public_path('upload/logo'), $fileName);
            $data['logo'] = $fileName;
            if($basicInfo->logo)
            {
                $imagePath = public_path('upload/logo/'.$basicInfo->logo);
                if(File::exists($imagePath))
                {
                    unlink($imagePath);
                }
            }
        }else{
            unset($data['logo']);
        }
        $basicInfo->update($data);
        return redirect('basic-infos')->with('alert',['messageType'=>'warning','message'=>'Data Updated Successfully!']);

    }

}