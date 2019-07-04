@extends('layouts.layout')

@section('content')
<div id="postConfirm">
    <div class="row mb-3">
        <div class="col-md-2"></div>
        <div class="col-md-16">
            <h5>Create Post Confirmation</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 mx-auto">
            <form action="/post/create" method="POST">
                @csrf

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Title:</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="title">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Description:</label>
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="title">
                    </div>
                </div><br><br>
                <!-- <div class="form-group">
                    <label>Description</label>
                    <label class="border border-dark col">Description</label>
                    <input type="hidden" name="desc" value="">
                </div> -->
                <div class="form-group">
                <div class="col-md-5">
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
