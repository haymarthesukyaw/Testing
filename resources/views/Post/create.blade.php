@extends('layouts.layout')

@section('content')
<div id="createPost">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col">
            <h5>Create Post</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="/post/create" method="POST">
            @csrf
            @method('PUT')
                <div class="form-group row">
                    <label for="title" class="col-md-4">Title:</label>
                    <input type="text" id="title" name="title" class="form-control col-md-6" value="{{old('title', session('title'))}}">
                    @if ($errors->has('title'))
                        <label class="text-danger mt-2 mb-0">{{ $errors->first('title') }}</label>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="desc" class="col-md-4">Description:</label>
                    <textarea name="desc" id="desc" class="form-control col-md-6">{{old('desc', session('desc'))}}</textarea>
                    @if ($errors->has('desc'))
                        <label class="text-danger mt-2 mb-0">{{ $errors->first('desc') }}</label>
                    @endif
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mr-4">Confirm</button>
                        <button type="reset" class="btn btn-dark">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
