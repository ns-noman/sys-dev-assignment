@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.flash-message')
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
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="top-left">
                                            <label>Project Name</label>
                                            <select class="normalize" name="projectID" id="projectID" required>
                                                <option value="">Select Project</option>
                                                @foreach ($projects as $project)
                                                    <option selected value="{{ $project->id }}">{{ $project->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="top-left">
                                            <label>Status</label>
                                            <select class="form-control" required name="status" id="status">
                                                <option value=-1 selected>All</option>
                                                <option value=0>Open</option>
                                                <option value=1>Closed</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-1 p-2">
                                        <button class="btn btn-danger weight mt-4" type="button" name="refresh"
                                            id="refresh" style="padding-bottom: 5px;border-radius: 4px;"><i
                                                class="fa fa-refresh" style="font-size:18px;"></i></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-primary p-1">
                                <h3 class="card-title">
                                    <a href="{{ route('flats.create') }}"class="btn btn-light shadow rounded m-0"><i
                                            class="fas fa-plus"></i>
                                        <span>Add New</span></i></a>
                                </h3>
                            </div>
                            <div class="card-body">
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-centre">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Project Name</th>
                                                    <th>Flat Name</th>
                                                    <th>Rent</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Project Name</th>
                                                    <th>Flat Name</th>
                                                    <th>Rent</th>
                                                    <th>Status</th>
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

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#projectID, #status').change(function() {
                myfun();
            });
            myfun();
        });

        function myfun() {
            var projectID = $('#projectID').find('option:selected').val();
            var status = $('#status').find('option:selected').val();
            $.ajax({
                url: "{{ url('flat-details') }}/" + projectID + '/' + status,
                method: "GET",
                dataType: "json",
                success: function(data) {
                    var tBody = '';
                    $.each(data, function(key, value) {
                        tBody += '<tr>';
                        tBody += '<td>' + (key + 1) + '</td>';
                        tBody += '<td>' + value.name + '</td>';
                        tBody += '<td>' + value.flatName + '</td>';
                        tBody += '<td>' + value.rent + '</td>';
                        if (value.status == 0) {
                            tBody +=
                                '<td><button class="btn btn-sm btn-success" style="width: 100%;">Open</button></td>';
                        } else {
                            tBody +=
                                '<td><button class="btn btn-sm btn-danger" style="width: 100%;">Closed</button></td>';
                        }
                        tBody += '<td><div class="d-flex justify-content-center">';
                        tBody += '<a href="flats/' + value.id + '/edit" class="btn btn-info">';
                        tBody += '<i class="fa-sharp fa-solid fa-pen-to-square"></i></a>';
                        tBody += '<form action="flats/' + value.id +'" method="POST">@csrf @method('DELETE')';
                        tBody += '<button type="submit" class="btn btn-danger">';
                        tBody += '<i class="fa-sharp fa-solid fa-trash"></i></button></form></div></td>';
                        tBody += '</tr>';
                    });
                    $('tbody').html(tBody);
                }
            });
        }
        $('#refresh').click(function() {
            location.reload();
        });
    </script>
@endsection
