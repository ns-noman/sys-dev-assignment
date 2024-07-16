@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Flats</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Flats</li>
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
                                <h3 class="card-title">Create Form</h3>
                            </div>
                            <form action="{{ route('flats.store') }}" method="POST">
                                @csrf()
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label>Select Project</label>
                                            <select class="normalize" required name="projectID">
                                                <option value=''>Select Project</option>
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Flat Name</label>
                                            <input type="text" class="form-control" required name="flatName"
                                                placeholder="Flat Name">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Rent</label>
                                            <input type="number" class="form-control" required name="rent" placeholder="0.00">
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
