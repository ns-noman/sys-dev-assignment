@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Search Check List</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Check List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-2"></section>
                    <section class="col-lg-8">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Search Form</h3>
                            </div>
                            <form action="{{ url('checklists-search') }}" method="POST" id="searchForm">
                                @csrf()
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-10">
                                            <input type="text" class="form-control" name="search" id="search" placeholder="Search your query here...">
                                        </div>
                                        <div class="form-group col-lg-2 mb-7">
                                            <button type="submit" class="btn btn-primary">Search</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Description</th>
                                                <th>Remarks</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="item-table">
                                        </tbody>
                                </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <section class="col-lg-2"></section>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script type="text/javascript">

    $('#searchForm').on('keyup',function(e){
        e.preventDefault();
        let searchForm = document.getElementById("searchForm");
        let formData = new FormData(searchForm);
        $.ajax({
            url: searchForm.getAttribute("action"),
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (data) {
                console.log(data);
                var tbody = '';
                data.forEach(function callback(value, index){
                    tbody += '<tr>'
                    tbody +=     '<td>'+(index+1)+'</td>'
                    tbody +=     '<td>'+value.description+'</td>'
                    tbody +=     '<td>'+value.remarks+'</td>'
                    tbody += '<td><div class="d-flex justify-content-center">';
                    tbody += '<a href="checklists/' + value.id + '/edit" class="btn btn-info"><i class="fa-solid fa-pen-to-square"></i></a>';
                    tbody += '</div>';
                    tbody += '</td>';
                    tbody += '</tr>'
                });
                
                $(".item-table").html(tbody);

            }   
         });

    });
    

</script>
@endsection
