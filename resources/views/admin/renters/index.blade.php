@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.flash-message')
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
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-primary p-1">
                                <h3 class="card-title">
                                    <a href="{{ route('renters.create') }}"class="btn btn-light shadow rounded m-0"><i
                                            class="fas fa-plus"></i>
                                        <span>Add New</span></i></a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table id="example1" class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>Srl</th>
                                                    <th>Name</th>
                                                    <th>Project</th>
                                                    <th>Contact No</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Advaced Payment</th>
                                                    <th>Previous Balance</th>
                                                    <th>Note</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $item->name }}</td>
                                                        <td>{{ $item->project }}</td>
                                                        <td>{{ $item->contact }}</td>
                                                        <td>{{ $item->email }}</td>
                                                        <td>{{ $item->address }}</td>
                                                        <td>{{ $item->advance }}</td>
                                                        <td>{{ $item->prevBal }}</td>
                                                        <td>{{ $item->note }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ route('renters.edit', $item->id) }}"
                                                                    class="btn btn-info">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                                <a href="{{ route('renters.show', $item->id) }}"
                                                                    class="btn btn-warning">
                                                                    <i class="fa-solid fa-image"></i>
                                                                </a>
                                                                <form action="{{ route('renters.destroy', $item->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Srl</th>
                                                    <th>Name</th>
                                                    <th>Project</th>
                                                    <th>Contact No</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Advaced Payment</th>
                                                    <th>Previous Balance</th>
                                                    <th>Note</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
