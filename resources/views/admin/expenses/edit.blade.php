@extends('layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row  p-5">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-title">
                        <h4 class="p-3">Edit Expense</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ url('expenses/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @method('PATCH')
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label>Select Project</label>
                                        <select class="normalize" required name="projectID">
                                            <option value=''>Select Project</option>
                                            @foreach ($projects as $item)
                                            <option
                                                @if ($item->id == $data->projectID)
                                                    selected
                                                @endif
                                            value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Expense Head</label>
                                        <select class="normalize" required name="expenseheadID">
                                            <option value=''>Select Expense Head</option>
                                            @foreach ($expenseheads as $item2)
                                            <option 
                                            @if ($item2->id == $data->expenseHeadID)
                                                    selected
                                                @endif
                                                 value="{{ $item2->id }}">{{ $item2->expense_head }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Amount</label>
                                        <input value="{{ $data->amount }}" type="number" class="form-control" required name="amount" placeholder="Amount">
                                    </div>
                                    <div class="form-group col-6">
                                        <label>Date</label>
                                        <input value="{{ $data->date }}" type="date" class="form-control" required name="date">
                                    </div>
                                    <div class="form-group col-12">
                                        <label>Note</label>
                                        <input value="{{ $data->note }}" type="" class="form-control" name="note" placeholder="Note">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary ml-2 mt-3">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection