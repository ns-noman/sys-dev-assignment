<?php

namespace App\Http\Controllers;

use App\Models\Flat;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
class FlatController extends Controller
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
        
        // return back()->with('alert',['messageType'=>'warning','message'=>'You do not have permission to use!']);

        $data =  Flat::orderBy('id','desc')->get();
        $userRole = $this->user->roleid;
        $projects = Project::where('companyID', $this->user->companyid)->when($userRole,function($query,$userRole){
            if($userRole!=1)
            {
                $user = User::find($this->user->id);
                $auArray = explode(',',$user->assignedProjects);
                $query->whereIn('id',$auArray);
            }
        })
        ->orderBy('name','asc')->get();
        return view('admin.flat.index',compact('data','projects'));
    }
    public function create()
    {
        $userRole = $this->user->roleid;
        $data =  Project::where('companyID', $this->user->companyid)->when($userRole,function($query,$userRole){
            if($userRole!=1)
            {
                $user = User::find($this->user->id);
                $auArray = explode(',',$user->assignedProjects);
                $query->whereIn('id',$auArray);
            }
        })
        ->orderBy('name','asc')->get();
        return view('admin.flat.create',compact('data'));
    }
    public function flatDetails($projectID, $status)
    {

        if($status==-1){
            $data =  Flat::join('projects', 'projects.id','=','flats.projectID')
                            ->where('flats.projectID',$projectID)
                            ->select('flats.*','projects.name')
                            ->get();
        }else{
            $data =  Flat::join('projects', 'projects.id','=','flats.projectID')
                            ->where('flats.projectID',$projectID)
                            ->where('status',$status)
                            ->select('flats.*','projects.name')
                            ->get();
        }
        
        return response()->json($data);
    }
    public function store(Request $request)
    {
        return $data = $request->all();
        $data['companyID'] = $this->user->companyid;
        Flat::create($data);
        return redirect('flats');
    }
    public function edit(Flat $flat)
    {
        $data =  Project::orderBy('name','asc')->get();
        return view('admin.flat.edit',compact('flat','data'));
    }
    public function update(Request $request, $id)
    {
        $projectName = Project::find($request->projectID)->name;
        Flat::find($id)->update(
        [   
            'projectID'=>$request->projectID,
            'projectName'=>$projectName,
            'flatName'=>$request->flatName,
            'price'=>$request->price,
            'bookingAmount'=>$request->bookingprice,
            'note'=>$request->note
        ]);
        return redirect('flats');
    }
    public function destroy(Flat $flats)
    {
        return $flats;
        // $has = FlatSale::where('flatID',$flat->id)->get();
        // if(!count($has)){
        //     $flat->delete();
        // }
        // return redirect()->back();
    }
}
