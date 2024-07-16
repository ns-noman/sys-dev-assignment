@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Projects</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Projects</li>
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
                            <form method="post" action="{{ route('projects.update', $project->id)}}">
                              @csrf
                              @method('PATCH')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="form-label">Project Name</label>
                                            <input value="{{ $project->name }}" required type="text" class="form-control"
                                                id="project" name="project" placeholder="Enter Project Name">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="form-label">Area</label>
                                            <input value="{{ $project->area }}" required type="text" class="form-control"
                                                id="area" name="area" placeholder="Enter Area">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="form-label">Address</label>
                                            <input value="{{ $project->address }}" required type="text"
                                                class="form-control" id="address" name="address"
                                                placeholder="Enter Address">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label class="form-label">Note</label>
                                            <input value="{{ $project->note }}" type="text" class="form-control"
                                                id="note" name="note" placeholder="Enter Note">
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
