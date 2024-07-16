@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Posts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Posts</li>
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
                                <h3 class="card-title">Edit Form</h3>
                            </div>
                            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                                @csrf()
                                @method('patch')
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Title</label>
                                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $post->title }}">
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Description-1</label>
                                            <textarea class="form-control" name="description1" id="description1">{{ $post->description1 }}</textarea>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Description-2</label>
                                            <textarea class="form-control" name="description2" id="description2">{{ $post->description2 }}</textarea>
                                        </div>
                                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                                            <label>Description-3</label>
                                            <textarea class="form-control" name="description3" id="description3">{{ $post->description3 }}</textarea>
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
        $(document).ready(function(){
            $('#description1').summernote({
                placeholder: 'Description-1',
                tabsize: 2,
                height: 100
            });
            $('#description2').summernote({
                placeholder: 'Description-2',
                tabsize: 2,
                height: 100
            });
            $('#description3').summernote({
                placeholder: 'Description-3',
                tabsize: 2,
                height: 100
            });
        });
    </script>
@endsection
