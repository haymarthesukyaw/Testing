@extends('layouts.layout')

@section('content')
<div id="userProfile">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col">
            <h3>User Profile</h3>
        </div>
    </div>

    <div class="row">
        <!-- <div class="col-md-6 mx-auto">
            <div class="text-center mb-4">
                <img width="100px" height="80px" alt="User-profile" class="img-thumbnail"
                        src="">
            </div>
        </div> -->
        <div class="col-md-6 mx-auto">
            <form action="/user/edit" method="GET">
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-link">Edit Profile</button>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4">Name:</label>
                    <label class="col-md-6">name</label>
                    <input type="hidden" name="name">
                </div>
                <div class="form-group row">
                    <label class="col-md-4">Email Address:</label>
                    <label class="col-md-6">email</label>
                    <input type="hidden" name="email">
                </div>
                <div class="form-group row">
                    <label class="col-md-4">Password:</label>
                    <label class="col-md-6">********</label>
                    <input type="hidden" name="password">
                </div>
                <div class="form-group row">
                    <label class="col-md-4">Type:</label>
                    <label class="col-md-6">Admin</label>
                    <input type="hidden" name="type">
                </div>
                <div class="form-group row">
                    <label class="col-md-4">Phone:</label>
                    <label class="col-md-6">phone</label>
                    <input type="hidden" name="phone">
                </div>
                <div class="form-group row">
                    <label class="col-md-4">Date of Birth:</label>
                    <label class="col-md-6">dob</label>
                    <input type="hidden" name="dob">
                </div>
                <div class="form-group row">
                    <label class="col-md-4">Address:</label>
                    <label class="col-md-6">address</label>
                    <input type="hidden" name="address">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
