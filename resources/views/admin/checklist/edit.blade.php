@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Check List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Check List</li>
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
                            <form method="post" action="{{ route('checklists.update', $checkList->id)}}">
                              @csrf
                              @method('PATCH')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-5">
                                            <label>Description</label>
                                            <input value="{{ $checkList->description }}" type="text" class="form-control" name="description" id="description" placeholder="Description">
                                        </div>
                                        <div class="form-group col-lg-5">
                                            <label>Remarks</label>
                                            <input value="{{ $checkList->remarks }}" type="text" class="form-control" name="remarks" id="remarks" placeholder="Remarks">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
