@extends('layouts.app')
@section('content')
<style>
    .form_div{
        padding: 10px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Book</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <div class="form_div">
                    <form action="{{ route('book.update',$id)}}" method="POST"  enctype="multipart/form-data">
                    @csrf
                     @method('PUT') 
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" maxlength="250" value="{{$book->title ?? ''}}">
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <span  style="color: red;" class='validate'>{{ $errors->first('title') }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="author_name" class="form-label">Author Name</label>
                            <input type="text" class="form-control" name="author_name" id="author_name" maxlength="250"  value="{{$book->author_name ?? ''}}">
                            @if ($errors->has('author_name'))
                                <span class="help-block">
                                    <span  style="color: red;" class='validate'>{{ $errors->first('author_name') }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="genre" class="form-label">Genre</label>
                            <input type="text" class="form-control" name="genre" id="genre" maxlength="250"  value="{{$book->genre ?? ''}}">
                            @if ($errors->has('genre'))
                                <span class="help-block">
                                    <span  style="color: red;" class='validate'>{{ $errors->first('genre') }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea type="text" class="form-control" name="description" id="description"> {{$book->description ?? ''}} </textarea>
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <span  style="color: red;" class='validate'>{{ $errors->first('description') }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="isbn" class="form-label">ISBN</label>
                            <input type="text" class="form-control" name="isbn" id="isbn" maxlength="250"  value="{{$book->isbn ?? ''}}">
                            @if ($errors->has('isbn'))
                                <span class="help-block">
                                    <span  style="color: red;" class='validate'>{{ $errors->first('isbn') }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" id="image" maxlength="250">
                            @if ($errors->has('image'))
                                <span class="help-block">
                                    <span  style="color: red;" class='validate'>{{ $errors->first('image') }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="publisher_name" class="form-label">Publisher Name</label>
                            <input type="text" class="form-control" name="publisher_name" id="publisher_name" maxlength="250" value="{{$book->publisher_name ?? ''}}">
                            @if ($errors->has('publisher_name'))
                                <span class="help-block">
                                    <span  style="color: red;" class='validate'>{{ $errors->first('publisher_name') }}</span>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
