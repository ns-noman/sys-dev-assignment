@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Roles</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Roles</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Form</h3>
                            </div>
                            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                @csrf()
                                @method('PATCH')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label for="exampleInputEmail1">Role Name</label>
                                            <input type="text" class="form-control" id="exampleInputEmail1"
                                                placeholder="Role Name" name="role" value="{{ $role->role }}">
                                        </div>

                                        @if($role->roleID!=1)
                                            <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                                <label>Assign Menu Permission</label>
                                                <div class="row">
                                                    @foreach ($menuLists as $menuList)
                                                        <div class="col-12">
                                                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                <input name="menuList[]" value="{{ $menuList->id }}" type="checkbox" class="custom-control-input"
                                                                    id="menuList{{ $menuList->id }}" {{ in_array($menuList->id,$permittedMenu)?'checked':null }}>
                                                                <label class="custom-control-label" for="menuList{{ $menuList->id }}">{{ $menuList->name }}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

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
