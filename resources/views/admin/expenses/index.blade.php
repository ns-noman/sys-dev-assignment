@extends('layouts.master')
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Expenses</h1>
            </div>
        </div>
    </div>
</div>
<div class="card m-1 p-1">
    <div class="table-responsive">
        <a href="{{ url('expenses/create') }}"class="btn btn-primary mb-3">Add New</a>
        <table id="example1" class="table table-striped table-bordered table-centre">
            <thead>
                <tr>
                    <th>SN</th>
                    <th>Project Name</th>
                    <th>Expense Head</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>Date</th>
                    <th>Created By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->projectName }}</td>
                    <td>{{ $item->expenseHeadName }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->note }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->createdByName }}</td>
                    <td>
                    <div class="d-flex justify-content-center">
                        <div class="col-md-6 m-0 p-0">
                        <a href="{{ url('expenses/'.$item->id.'/edit') }}" class="btn btn-info">
                            <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                        </a>
                        </div>
                        <div class="col-md-6 m-0 p-0">
                            <form action="{{ url('expenses/'.$item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection