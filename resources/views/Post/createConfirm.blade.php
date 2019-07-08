@extends('layouts.layout')

@section('content')
<div id="createPostConfirm">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col">
            <h5>Create Post Confirmation</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="/post/create" method="POST">
                @csrf

                <div class="form-group row">
                    <label for="title" class="col-md-4">Title:</label>
                    <label class="col-md-6">This is title</label>
                    <input type="hidden" name="title">
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4">Description:</label>
                    <label class="col-md-6">This is description</label>
                    <input type="hidden" name="description">
                </div>

                <div class="form-group">
                <div class="col-md-10">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mr-4">Create</button>
                        <a href="" class="btn btn-dark">Cancel</a>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
