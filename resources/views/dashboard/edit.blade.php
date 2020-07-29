@extends('dashboard.layout')
   
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Artikel</div>
                <div class="card-body">
                    <form action="{{ route('dashboard.update', $post->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" value="{{ $post->title }}" class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Thumbnail:</strong>
                                    <input type="text" name="thumbnail" value="{{ $post->thumbnail }}" class="form-control" placeholder="Thumbnail">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Deskripsi:</strong>
                                    <textarea class="tinymce-editor form-control" name="content">{{ $post->content }}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <a class="btn btn-secondary" href="{{ route('dashboard.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger p-3 m-3">
                            Ada beberapa masalah dengan input anda:<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
