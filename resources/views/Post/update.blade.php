@extends('layouts.layout')

@section('content')
<div id="editPostConfirm">
    <div class="row mb-6">
        <div class="col-md-3"></div>
        <div class="col-md-16">
            <h3>Edit Post Confirm</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5 mx-auto">
            <form action="" method="POST">
                @csrf
                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Title:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="email">Description:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status" class="col-2 form-check-label">Status</label>
                    <div class="col-4">
                        <input type="checkbox" id="status" class="form-check-input">
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
