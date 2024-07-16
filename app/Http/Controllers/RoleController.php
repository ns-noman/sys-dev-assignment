<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use App\Models\MenuList;
use App\Models\MenuPermission;
use Illuminate\Http\Request;
use Auth;
class RoleController extends Controller
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
        $roles = Role::where('companyID',$this->user->companyid)->orderBy('roleID','asc')->get();
        return view('admin.roles.index', compact('roles'));
    }
    public function create()
    {
        $menuLists = MenuList::get();
        return view('admin.roles.create',compact('menuLists'));
    }

    public function store(Request $request)
    {
        $data['role'] = $request->role;
        $data['companyID'] = $this->user->companyid;
        $data['roleID'] = Role::where('companyID',$this->user->companyid)->orderBy('roleID','desc')->first()->roleID + 1;   
        $role = Role::create($data);
        $menuList = $request->menuList;
        foreach($menuList as $key=> $value) MenuPermission::create(['menuID'=>$value,'roleID'=> $data['roleID']]);

        return redirect('roles')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function edit(Role $role)
    {
        $menuPermission = MenuPermission::where('roleID','=', $role->roleID)->select('menuID')->get();
        $permittedMenu = [];
        foreach ($menuPermission as $key => $value) array_push($permittedMenu, $value->menuID);
        $menuLists = MenuList::get();

        return view('admin.roles.edit',compact('role', 'menuLists', 'permittedMenu'));
    }
    public function update(Request $request,Role $role)
    {
        $role->update($request->all());

        if(isset($request->menuList)){
            MenuPermission::where('roleID','=', $role->roleID)->delete();
            $menuList = $request->menuList;
            foreach($menuList as $key=> $value) MenuPermission::create(['menuID'=>$value,'roleID'=> $role->roleID]);
        }
        return redirect('roles')->with('alert',['messageType'=>'warning','message'=>'Data Updated Successfully!']);
    }
    public function destroy(Role $role)
    {
        $role = User::where('companyid',$this->user->companyid)->where('roleAutoID', $role->id)->get();
        if(!count($role))
        {
            $role->delete();
            return redirect()->back()->with('alert',['messageType'=>'danger','message'=>'Data Deleted Successfully!']);
        }
        return redirect()->back()->with('alert',['messageType'=>'warning','message'=>'Data can not be Deleted! Used in User table...']);
    }
}
