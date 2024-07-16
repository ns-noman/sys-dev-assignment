@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="form-group col-sm-6">
                        <h1 class="m-0">Basic Info</h1>
                    </div>
                    <div class="form-group col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Basic Info</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="form-group col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Form</h3>
                            </div>
                            <form action="{{ route('basic-infos.update', $basicInfo->id)}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('PATCH')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                                            <label class="form-label">Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                value="{{ $basicInfo->title }}" placeholder="Title">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $basicInfo->email }}"placeholder="Email">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label class="form-label">Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                value="{{ $basicInfo->phone }}" placeholder="Phone">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label for="inputAddress" class="form-label">Address</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                value="{{ $basicInfo->address }}" placeholder="Address">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label for="inputAddress2" class="form-label">Logo</label>
                                            <input type="file" name="logo" class="form-control">
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
