@extends('layouts.layout')

@section('content')
<div id="editPost">
    <div class="row mb-3">
        <div class="col-md-3"></div>
        <div class="col-md-16">
            <h5>Update Post</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mx-auto">
            <form action="" method="POST">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{old('title', session('title'))}}">
                    @if ($errors->has('title'))
                        <label class="text-danger mt-2 mb-0">{{ $errors->first('title') }}</label>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description" class="">Description</label>
                    <textarea name="description" id="description" class="form-control">{{old('description', session('description'))}}</textarea>
                    @if ($errors->has('description'))
                        <label class="text-danger mt-2 mb-0">{{ $errors->first('description') }}</label>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="status" class="col-2 form-check-label">Status</label>
                    <div class="col-4">
                        <input type="checkbox" id="status" class="form-check-input">
                    </div>
                </div>
                <input type="hidden" name="create_user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="updated_user_id" value="{{Auth::user()->id}}">
                <input type="hidden" name="deleted_user_id" value="{{Auth::user()->id}}">

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
