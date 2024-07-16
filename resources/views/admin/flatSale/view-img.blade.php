@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <h3 class="p-3">Documents Gallery</h3>
    <div class="row m-1">
        @foreach ($data as $item)
            <div class="col-sm-6 col-lg-3 col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="basic-form">
                            <img height="200" width="200" src="{{ asset('public/upload/'. $item->image ) }}" alt="img">
                            <br>
                            <a href="{{ url('proImgDel/'.$item->id) }}" class="btn btn-danger">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
