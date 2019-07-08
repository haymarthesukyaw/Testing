@extends('layouts.layout')

@section('content')
<div id="editUserConfirm">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col">
            <h5>Edit User Confirm</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="col-md-8  mx-auto">
                <div class="text-center mb-4">
                    <img width="100px" height="80px" src="" alt="User-profile" class="img-thumbnail">
                </div>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="form-group row">
                    <label class="control-label col-md-4" for="name">Name:</label>
                    <label class="col-md-6">This is name</label>
                    <input type="hidden" class="form-control col-md-6" id="name" value="Name">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="email">Email:</label>
                    <label class="col-md-6">This is email</label>
                    <input type="hidden" class="form-control col-md-6" id="email">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="type">Type:</label>
                    <label class="col-md-6">This is type</label>
                    <input type="hidden" class="form-control col-md-6" id="type">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="phone">Phone:</label>
                    <label class="col-md-6">This is phone</label>
                    <input type="hidden" class="form-control col-md-6" id="phone">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="dob">Date of Birth:</label>
                    <label class="col-md-6">This is dob</label>
                    <input type="hidden" class="form-control col-md-6" id="dob">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="address">Address:</label>
                    <label class="col-md-6">This is dob</label>
                    <input type="hidden" class="form-control col-md-6" id="address">
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mr-4">Update</button>
                        <a href="" class="btn btn-dark">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
