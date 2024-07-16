<?php

namespace App\Http\Controllers;

use App\Models\ExpenseHead;
use Illuminate\Http\Request;
use Auth;
class ExpenseHeadController extends Controller
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
        $expenseheads = ExpenseHead::where('companyID', $this->user->companyid)->orderBy('name','asc')->get();
        return view('admin.expenseheads.index',compact('expenseheads'));
    }
    public function create()
    {
        return view('admin.expenseheads.create');
    }
    public function store(Request $request)
    {
        $data['companyID'] = $this->user->companyid;
        $data['name'] = $request->name;
        $data['code'] = $request->code;
        ExpenseHead::create($data);
        return redirect('expenseheads')->with('alert',['messageType'=>'success','message'=>'Data Inserted Successfully!']);
    }
    public function show(ExpenseHead $expenseHead)
    {
        //
    }
    public function edit($id)
    {
        $expensehead = ExpenseHead::find($id);
        return view ('admin.expenseheads.edit',compact('expensehead'));
    }
    public function update(Request $request,ExpenseHead $expensehead)
    {
        $data = $request->all();
        $expensehead->update($data);
        return redirect('expenseheads')->with('alert',['messageType'=>'warning','message'=>'Data Updated Successfully!']);
    }
    public function destroy($id)
    {
        ExpenseHead::destroy($id);
        return redirect('expenseheads')->with('alert',['messageType'=>'danger','message'=>'Data Deleted Successfully!']);
    }
}
