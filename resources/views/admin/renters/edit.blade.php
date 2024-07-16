@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Renters</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Renters</li>
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
                            <form action="{{ route('renters.update', $renter->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                @method("PATCH")
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label>Renter Name</label>
                                            <input value="{{ $renter->name }}" type="text" class="form-control" required name="name" placeholder="Renter Name">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Contact No.</label>
                                            <input value="{{ $renter->contact }}" type="number" class="form-control" name="contact" placeholder="01800000000">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Email</label>
                                            <input value="{{ $renter->email }}" type="email" class="form-control" required name="email" placeholder="example@gmail.com">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Present Address</label>
                                            <input value="{{ $renter->address }}" type="text" class="form-control" name="address" placeholder="Address">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Adavanced Collection</label>
                                            <input value="{{ $renter->advance }}" type="number" class="form-control" required name="advance" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Previous Balance</label>
                                            <input value="{{ $renter->prevBal }}" type="number" class="form-control" required name="prevBal" placeholder="0.00">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Projects</label>
                                            <select class="normalize" name="projectID" id="projectID">
                                                <option value="">Select Project</option>
                                                @foreach ($projects as $project)
                                                    <option value="{{ $project->id }}" {{ $project->id==$renter->projectID? 'selected':null }}>{{ $project->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label>Images</label>
                                            <input type="file" class="form-control" name="images[]" multiple>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Note</label>
                                            <input value="{{ $renter->note }}" type="text" class="form-control" name="note" placeholder="Note">
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
