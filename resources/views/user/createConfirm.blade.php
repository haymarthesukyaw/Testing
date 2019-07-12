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
                <input type="hidden" name="filename" value="{{$filename}}">
                <div class="form-group row">
                    <label for="name" class="col-md-4">Name:</label>
                    <label class="col-md-6">{{$name}}</label>
                    <input type="hidden" name="user_name" value="{{$name}}">
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4">Email Address:</label>
                    <label class="col-md-6">{{$email}}</label>
                    <input type="hidden" name="email" class="form-control" value="{{$email}}">
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4">Password:</label>
                    <label class="col-md-6">{{$pwd_hide}}</label>
                    <input type="hidden" name="password" class="form-control" value="{{$pwd}}">
                </div>

                <div class="form-group row">
                    <label for="type" class="col-md-4">Type:</label>
                    @if ($type == null || $type == 1) <label class="border border-dark p-2 col-md-6">User</label>
                        @else <label class="border border-dark p-2 col-md-6">Admin</label>
                    @endif
                    <input type="hidden" name="type" class="form-control" value="{{$type}}">
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4">Phone:</label>
                    <label class="col-md-6">{{$phone}}</label>
                    <input type="hidden" name="phone" class="form-control" value="{{$phone}}">
                </div>

                <div class="form-group row">
                    <label for="dob" class="col-md-4">Date of Birth:</label>
                    <label class="col-md-6">{{date('d-m-Y', strtotime($dob))}}</label>
                    <input type="hidden" name="dob" class="form-control" value="{{$dob}}">
                </div>

                <div class="form-group row">
                    <label for="address" class="col-md-4">Address:</label>
                    <label class="col-md-6">{{$address}}</label>
                    <input type="hidden" name="address" class="form-control" value="{{$address}}">
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
