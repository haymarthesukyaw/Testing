@extends('layouts.layout')

@section('content')
<div id="userConfirm">
    <div class="row mb-6">
        <div class="col-md-1"></div>
        <div class="col">
            <h5>Create User Confirmation</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="col-md-8  mx-auto">
                <div class="text-center mb-4">
                    <img width="100px" height="80px" src="" alt="User-profile" class="img-thumbnail col-md-6">
                </div>
            </div>
            <form action="/user/create" method="POST">
                @csrf
                <div class="form-group row">
                    <label for="name" class="col-md-4">Name:</label>
                    <label class="col-md-6">This is name</label>
                    <input type="hidden" name="name">
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4">Email Address:</label>
                    <label class="col-md-6">This is email</label>
                    <input type="hidden" class="form-control" id="email">
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4">Password:</label>
                    <label class="col-md-6">This is password</label>
                    <input type="hidden" class="form-control" id="password">
                </div>

                <div class="form-group row">
                    <label for="type" class="col-md-4">Type:</label>
                    <label class="col-md-6">This is type</label>
                    <input type="hidden" class="form-control" id="type">
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4">Phone:</label>
                    <label class="col-md-6">This is phone</label>
                    <input type="hidden" class="form-control" id="phone">
                </div>

                <div class="form-group row">
                    <label for="dob" class="col-md-4">Date of Birth:</label>
                    <label class="col-md-6">This is dob</label>
                    <input type="hidden" class="form-control" id="dob">
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4">Address:</label>
                    <label class="col-md-6">This is address</label>
                    <input type="hidden" class="form-control" id="address">
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
