@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Users</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Users</li>
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
                                    <a href="{{ route('users.create') }}"class="btn btn-light shadow rounded m-0"><i
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
                                                    <th>Srl.</th>
                                                    <th>Full Name</th>
                                                    <th>Role</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Contact No.</th>
                                                    <th>Reference Person</th>
                                                    <th>Assigned To Projects</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->role }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->address }}</td>
                                                        <td>{{ $user->contact_no }}</td>
                                                        <td>{{ $user->reference_by }}</td>
                                                        <td>{{ $user->assignedProjects }}</td>
                                                        <td>
                                                            <div class="d-flex justify-content-center">
                                                                <a href="{{ url('users/' . $user->id . '/edit') }}"
                                                                    class="btn btn-info">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                                @if ($user->roleid == 1)
                                                                    <button class="btn btn-danger" disabled>
                                                                        <i class="fa-solid fa-trash-can"></i>
                                                                    </button>
                                                                @else
                                                                    <form action="{{ url('users/' . $user->id) }}"
                                                                        method="post">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <i class="fa-solid fa-trash-can"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                <a href="{{ route('users.show', $user->id) }}"
                                                                    class="btn btn-warning">
                                                                    <i class="fa-solid fa-image"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Srl.</th>
                                                    <th>Full Name</th>
                                                    <th>Role</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Contact No.</th>
                                                    <th>Reference Person</th>
                                                    <th>Assigned To Projects</th>
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
