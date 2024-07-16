@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Expense Heads</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Expense Heads</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Form</h3>
                            </div>
                            <form action="{{ route('expenseheads.update', $expensehead->id) }}" method="POST">
                                @csrf()
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Expense Heads</label>
                                            <input required type="text" class="form-control" name="name"
                                                placeholder="Expense Heads" value="{{ $expensehead->name }}">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Code</label>
                                            <input type="text" class="form-control" name="code" placeholder="Code"
                                                value="{{ $expensehead->code }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
