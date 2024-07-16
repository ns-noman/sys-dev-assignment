<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Role;
use App\Models\Project;
use App\Models\UserDocument;
use App\Models\MenuList;
use App\Models\MenuPermission;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Auth;

class UserController extends Controller
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
        $users = User::join('roles','roles.id','=','users.roleAutoID')
            ->select('users.*','roles.role')
            ->where('users.companyid',$this->user->companyid)->orderBy('users.roleid','asc')->get();

        return view('admin.users.index', compact('users'));
    }
    public function create()
    {
        $role = Role::where('companyID',$this->user->companyid)->where('roleID','!=',1)->get();
        return view('admin.users.create',compact('role'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['roleid'] = Role::find($data['roleAutoID'])->roleID;

        $images = $request->images;
        unset($data['images']);
        $data['password'] = Hash::make($request->password);
        $data['companyid'] = $this->user->companyid;
        $user = User::create($data);

        //Documents
        $userID = $user->id;
        $i = 0;
        if($images)
        {
            foreach($images as $img)
            {
                $imagesDoc = 'user-doc-'. time(). $i .'.'.$img->getClientOriginalExtension();
                $img->move(public_path('upload/userdoc'), $imagesDoc);
                $data = 
                [
                    'userID'=>$userID,
                    'image'=>$imagesDoc
                ];
                UserDocument::create($data);
                $i++;
            }
        }

        return redirect('users')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }

    public function edit($id)
    {
        $user = User::find($id); 
        $role = $this->user->roleid == $user->roleid ? Role::where('id', $this->user->roleAutoID)->get(): Role::where('companyID', $this->user->companyid)->where('id','!=', $this->user->roleAutoID)->get();
        return view('admin.users.edit',compact('user','role'));
    }
    public function update(Request $request,User $user)
    {
        $data = $request->all();
        $data['roleid'] = Role::find($data['roleAutoID'])->roleID;
        $images = $request->images;
        unset($data['images']);
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }else{
            unset($data['password']);
        }
        $user->update($data);

        //Documents
        $userID = $user->id;
        $i = 0;
        if($images)
        {
            foreach($images as $img)
            {
                $imagesDoc = 'user-doc-'. time(). $i .'.'.$img->getClientOriginalExtension();
                $img->move(public_path('upload/userdoc'), $imagesDoc);
                $data = 
                [
                    'userID'=>$userID,
                    'image'=>$imagesDoc
                ];
                UserDocument::create($data);
                $i++;
            }
        }
        return redirect('users')->with('alert',['messageType'=>'warning','message'=>'Data Updated Successfully!']);
    }
    public function destroy($id)
    {
        $userData = User::find($id);
        $images = UserDocument::where('userID', $userData->id)->get();
        foreach($images as $value)
        {
            $image = $value->image;
            unlink(public_path('upload/userdoc/'.$image));
        }
        UserDocument::where('userID', $userData->id)->delete();

        User::destroy($id);
        return redirect()->back()->with('alert',['messageType'=>'danger','message'=>'Data Deleted Successfully!']);;
    }
    public function show($id)
    {
        $data = UserDocument::where('userID',$id)->get();
        return view('admin.users.view-img',compact('data'));
    }
    public function destroyUserDoc($id)
    {
        $image = UserDocument::find($id)->image;
        UserDocument::destroy($id);
        unlink(public_path('upload/userdoc/').$image);
        return redirect()->back()->with('alert',['messageType'=>'danger','message'=>'Data Document Successfully!']);
    }

}