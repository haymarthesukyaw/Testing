@extends('layouts.layout')

@section('content')
<div id="editPostConfirm">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col">
            <h5>Update Post Confirm</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{route('posts.update',$id)}}" method="POST">
                @csrf

                <div class="form-group row">
                    <label class="control-label col-md-4" for="title">Title:</label>
                    <label class="col-md-6">{{$title}}</label>
                    <input type="hidden" class="form-control col-md-6" name="title" id="title" value="{{$title}}">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="description">Description:</label>
                    <label class="col-md-6">{{$desc}}</label>
                    <input type="hidden" class="form-control col-md-6" name="desc" id="description" value="{{$desc}}">
                </div>

                <div class="form-group row">
                    <label class="col-md-4 form-check-label" for="status">Status</label>
                    <div class="col">
                        <input type="checkbox" id="status" name="status" class="form-check-input col-md-1" value="{{$status}}">
                        <input type="hidden" class="form-control col-md-6" name="status" id="description" value="{{$status}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary  mr-4">Update</button>
                        <a href="" class="btn btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
