@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        @if (Auth::user()->roleid == 1)
            <div class="content-header">
                @include('layouts.flash-message')
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Users Documents</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Users Documents</li>
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
                                        <a href="{{ route('users.index') }}"class="btn btn-light shadow rounded m-0">
                                            <span>Back</span></i></a>
                                    </h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach($data as $item)
                                            <div class="col-sm-6 col-lg-3 col-md-3">
                                                <div class="card shadow">
                                                    <div class="card-body">
                                                        <img height="200px" width="200px"
                                                            src="{{ asset('public/upload/userdoc/' . $item->image) }}" alt="img">
                                                    </div>
                                                    <div class="card-footer">
                                                        <div class="row">
                                                            <div class="col-6 d-flex justify-content-left">
                                                                <a href="{{ url('destroy-user-doc/' . $item->id) }}" class="btn btn-danger">
                                                                    <i class="fa-solid fa-trash-can"></i>
                                                                </a>
                                                            </div>
                                                            <div class="col-6 d-flex justify-content-right">
                                                                <a href="{{ asset('public/upload/userdoc/' . $item->image) }}" class="btn btn-success d-flex justify-content-right" download>
                                                                    Download
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                        
                    </div>
                </div>
            </section>
        @else
            <p>You are not authorized!</p>
        @endif
    </div>
@endsection
