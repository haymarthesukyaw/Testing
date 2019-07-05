@extends('layouts.layout')

@section('content')
<div id="createPostConfirm">
    <div class="row mb-6">
        <div class="col-md-3"></div>
        <div class="col-md-16">
            <h5>Create Post Confirmation</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="/post/create" method="POST">
                @csrf

                <div class="form-group">
                <div class="m-3 pb-3">
                    <label class="control-label col-sm-2" for="email">Title:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title">
                    </div>
                </div>
                </div>

                <div class="form-group">
                <div class="m-3 pb-3">
                    <label class="control-label col-sm-2" for="email">Description:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title">
                    </div>
                </div>
                </div>

                <div class="form-group">
                <div class="col-md-10">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary  mr-4">Create</button>
                        <a href="" class="btn btn-dark">Cancel</a>
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
