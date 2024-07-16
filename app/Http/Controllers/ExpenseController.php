<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseHead;
use App\Models\Project;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Expense::orderBy('id','desc')->get();   
        return view('admin.expenses.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::orderBy('name','asc')->get();
        $expenseheads = ExpenseHead::orderBy('expense_head','asc')->get();
        return view('admin.expenses.create',compact('projects','expenseheads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = session()->get('userData')[0]->id;
        $name = session()->get('userData')[0]->name;
        $projectName = Project::find($request->projectID)->name; 
        $expenseHeadName = ExpenseHead::find($request->expenseheadID)->expense_head; 
        Expense::create(
        [
            'projectID'=>$request->projectID,
            'projectName'=>$projectName,
            'expenseHeadID'=>$request->expenseheadID,
            'expenseHeadName'=>$expenseHeadName,
            'amount'=>$request->amount,
            'note'=>$request->note,
            'date'=>$request->date,
            'createdByID'=>$id,
            'createdByName'=>$name,
        ]);
        return redirect('expenses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        
        $data = $expense;
        $projects = Project::orderBy('name','asc')->get();
        $expenseheads = ExpenseHead::orderBy('expense_head','asc')->get();
        return view('admin.expenses.edit',compact('projects','expenseheads','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $id = session()->get('userData')[0]->id;
        $name = session()->get('userData')[0]->name;
        $projectName = Project::find($request->projectID)->name; 
        $expenseHeadName = ExpenseHead::find($request->expenseheadID)->expense_head; 

        $expense->update(
        [
            'projectID'=>$request->projectID,
            'projectName'=>$projectName,
            'expenseHeadID'=>$request->expenseheadID,
            'expenseHeadName'=>$expenseHeadName,
            'amount'=>$request->amount,
            'note'=>$request->note,
            'date'=>$request->date,
            'createdByID'=>$id,
            'createdByName'=>$name,
        ]);
        return redirect('expenses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $expense->destroy($expense->id);
        return redirect('expenses');
    }
}
