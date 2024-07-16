@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Search Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Search Post</li>
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
                            <form action="{{ url('post-search-result') }}" method="POST" id="searchForm">
                                @csrf()
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <input type="text" class="form-control" name="search" id="search" placeholder="Search your query here...">
                                        </div>
                                    </div>
                                    <div class="row">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>SN</th>
                                                <th>Title</th>
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
                var tbody = '';
                data.forEach(function callback(value, index){
                    tbody += '<tr>'
                    tbody +=     '<td>'+(index+1)+'</td>'
                    tbody +=     '<td><a href="posts/search/details/' + value.id + '">'+value.title+'</a></td>'
                    tbody += '</tr>'
                });
                
                $(".item-table").html(tbody);

            }   
         });

    });
    

</script>
@endsection
