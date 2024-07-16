@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Basic Info</h1>
                    </div>
                    <div class="col-sm-6">
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
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $basicInfo->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $basicInfo->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td>{{ $basicInfo->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th>Address</th>
                                            <td>{{ $basicInfo->address }}</td>
                                        </tr>
                                        <tr>
                                            <th>Logo</th>
                                            <td>
                                                @if ($basicInfo->logo)
                                                    <img src="{{ asset('public/upload/logo/' . $basicInfo->logo) }}"
                                                        alt="logoimage" height="150px" width="150px">
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('basic-infos.edit', $basicInfo->id) }}"
                                    class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection
