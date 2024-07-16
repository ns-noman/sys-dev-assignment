@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
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
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Create Form</h3>
                            </div>
                            <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf()
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Full Name</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Full Name">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>User Role</label>
                                            <select class="form-control" name="roleAutoID">
                                                <option value=''>Select User Role</option>
                                                @foreach ($role as $item)
                                                    <option value="{{ $item->id }}">{{ $item->role }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                placeholder="Address">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Contact No.</label>
                                            <input type="number" class="form-control" name="contact_no"
                                                placeholder="01800000000">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Reference Person</label>
                                            <input type="text" class="form-control" name="reference_by"
                                                placeholder="Reference Person">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Password</label>
                                            <input required type="password" class="form-control" id="password" name="password"
                                            placeholder="Password">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-6 col-lg-6">
                                            <label>Confirm Password</label>
                                            <input required type="password" onkeyup="checkPassword()" class="form-control"
                                                id="conpassword" name="conpassword" placeholder="Confirm Password">
                                        </div>
                                        <div class="form-group col-12">
                                            <label>Document Images</label>
                                            <input type="file" class="form-control" name="images[]" multiple>
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
@section('script')
    <script type="text/javascript">
        function checkPassword() {
            var x = document.getElementById("password").value;
            var y = document.getElementById("conpassword").value;
            if (x == y) {

                var input = document.getElementById("conpassword");
                input.style.borderColor = 'green';
            } else {
                var input = document.getElementById("conpassword");
                input.style.borderColor = 'red';
            }
        }
    </script>
@endsection
