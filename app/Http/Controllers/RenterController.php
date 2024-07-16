<?php

namespace App\Http\Controllers;

use App\Models\Renter;
use App\Models\Project;
use App\Models\RenterDoc;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class RenterController extends Controller
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
        $userRole = $this->user->roleid;
        $data = Renter::join('projects','projects.id','=','renters.projectID')->select('projects.name as project','renters.*')
                    ->orderBy('projects.id','desc')->get();
        return view('admin.renters.index',compact('data'));
    }

    public function create()
    {
        $userRole = $this->user->roleid;
        $projects = Project::where('companyID', $this->user->companyid)->when($userRole,function($query,$userRole){
            if($userRole!=1)
            {
                $user = User::find($this->user->id);
                $auArray = explode(',',$user->assignedProjects);
                $query->whereIn('id',$auArray);
            }
        })->get();
        return view('admin.renters.create',compact('projects'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['companyID'] = $this->user->companyid;
        $data['password'] = Hash::make($data['contact']);
        $images = $request->images?$request->images:[];

        $renter = Renter::create($data);

        // Documents
        $renterID = $renter->id;
        $i = 0;
        foreach($images as $img){
            $imagesDoc = time(). $i .'.'. strtolower($img->getClientOriginalExtension());
            $img->move(public_path('upload/renters/'), $imagesDoc);
            $data = 
            [
                'companyID'=> $this->user->companyid,
                'renterID'=> $renterID,
                'image'=> $imagesDoc
            ];
            RenterDoc::create($data);
            $i++;
        }
        // End

        return redirect('renters');
    }
    public function show($id)
    {
        $data = RenterDoc::where('renterID',$id)->get();
        return view('admin.renters.view-img',compact('data'));
    }
    public function edit(Renter $renter)
    {
        $userRole = $this->user->roleid;
        $projects = Project::where('companyID', $this->user->companyid)->when($userRole,function($query,$userRole){
            if($userRole!=1)
            {
                $user = User::find($this->user->id);
                $auArray = explode(',',$user->assignedProjects);
                $query->whereIn('id',$auArray);
            }
        })->get();
        return view('admin.renters.edit',compact('projects','renter'));
    }

    public function update(Request $request, Renter $renter)
    { 
        $data = $request->all();
        $data['password'] = Hash::make($data['contact']);
        $images = $request->images?$request->images:[];

        $renter->update($data);

        // Documents
        $renterID = $renter->id;
        $i = 0;
        foreach($images as $img)
        {
            $imagesDoc = time(). $i .'.'. strtolower($img->getClientOriginalExtension());
            $img->move(public_path('upload/renters/'), $imagesDoc);
            $data = 
            [
                'companyID'=> $this->user->companyid,
                'renterID'=> $renterID,
                'image'=> $imagesDoc
            ];
            RenterDoc::create($data);
            $i++;
        }
        // End
        return redirect('renters');
    }
    public function destroy(Renter $renter)
    {
        $images = RenterDoc::where('renterID', $renter->id)->get();
        foreach($images as $value)
        {
            $image = $value->image;
            unlink(public_path('upload/renters/'.$image));
        }
        RenterDoc::where('renterID', $renter->id)->delete();
        $renter->delete();
        return redirect()->back();
    }
    public function destroyRentersDoc($id)
    {
        $renterDoc = RenterDoc::find($id);
        unlink(public_path('upload/renters/'.$renterDoc->image));
        $renterDoc->delete();
        return redirect()->back();
    }
}
