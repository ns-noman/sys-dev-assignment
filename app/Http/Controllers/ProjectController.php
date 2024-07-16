<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class ProjectController extends Controller
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

        $project = Project::where('companyID', $this->user->companyid)->when($userRole,function($query,$userRole){
            if($userRole!=1)
            {
                $user = User::find($this->user->id);
                $auArray = explode(',',$user->assignedProjects);
                $query->whereIn('id',$auArray);
            }
        })->get();

        return view('admin.project.index',compact('project'));
    }

    public function create()
    {
        $userRole = $this->user->roleid;
        $users = User::when($userRole ,function($query,$userRole){
            if($userRole == 1)
            {
                $query->where('roleid','!=', $userRole);
            }else
            {
                $query->where('roleid','!=',1)->where('id', $this->user->id);
            }
        })->orderBy('name')->get();
        return view('admin.project.create',compact('users'));
    }

    public function store(Request $request)
    {
        Project::create([
            'companyID'=>$this->user->companyid,
            'name'=>$request->name,
            'address'=>$request->address
        ]);
        return redirect('projects');
    }

    public function edit(Project $project)
    {
        return view('admin.project.edit',compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $project->update(
            [
                'name'=>$request->project,
                'area'=>$request->area,
                'address'=>$request->address,
                'note'=>$request->note,
            ]
        );
        return redirect('projects');
    }

    public function destroy($id)
    {
        Project::destroy($id);
        return back()->with('warning', 'Project Deleted Successfully!');
    }
}
