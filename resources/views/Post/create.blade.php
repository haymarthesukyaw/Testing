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
                    <input type="text" id="title" name="title" class="form-control col-md-6">
                    @if ($errors->has('title'))
                        <label class="text-danger mt-2 mb-0">{{ $errors->first('title') }}</label>
                    @endif
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4">Description:</label>
                    <textarea name="description" id="description" class="form-control col-md-6"></textarea>
                    @if ($errors->has('description'))
                        <label class="text-danger mt-2 mb-0">{{ $errors->first('description') }}</label>
                    @endif
                </div>

                <!-- <input type="hidden" name="create_user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="updated_user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="deleted_user_id" value="{{Auth::user()->id}}"> -->

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
