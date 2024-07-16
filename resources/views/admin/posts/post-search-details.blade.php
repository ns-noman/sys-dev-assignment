@extends('layouts.master')
@section('content')
    <style>
        .collapsible {
            background-color: #777;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            }
        .active, .collapsible:hover {
            background-color: #029edb;
        }
        .collapse-content {
            padding: 0 18px;
            display: none;
            overflow: hidden;
            background-color: #f1f1f1;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            @include('layouts.flash-message')
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $post->title }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item">Posts</li>
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
                                <div class="bootstrap-data-table-panel">
                                    <div class="table-responsive">
                                        <h2>{{ $post->title }}</h2>
                                        <p>{!! $post->description1 !!}{!! $post->description2 !!}{!! $post->description3 !!}</p>
                                        <a href="{{ url('posts/' . $post->id . '/edit') }}">Edit this post</a>
                                    </div>
                                    <div class="table-responsive mt-4">
                                        <h5>{{ __('Reference Post') }}</h5>
                                        @foreach ($reference as $rfc)
                                            <?php
                                                $date = date_create("2013-03-15");
                                            ?>
                                            <button type="button" class="collapsible">{{ $post->id }}.{{ $rfc->updateNo }} : {{ $rfc->name }} ({{ date_format($rfc->created_at,"d-M-Y") }}) {{ $rfc->title }}</button>
                                            <div class="collapse-content">
                                                <p>{!! $rfc->description1 !!}{!! $rfc->description2 !!}{!! $rfc->description3 !!}</p>
                                            </div>
                                        @endforeach
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
<script>
    var coll = document.getElementsByClassName("collapsible");
    var i;
    
    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    }
</script>
@endsection