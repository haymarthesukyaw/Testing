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
            <form action="/user/{{$user_id}}" method="POST">
                @csrf
                <input type="hidden" name="oldProfile" value="{{$old_profile}}">
                <input type="hidden" name="newProfile" value="{{$user->profile}}">
                <div class="form-group row">
                    <label class="control-label col-md-4" for="name">Name:</label>
                    <label class="col-md-6">{{$user->name}}</label>
                    <input type="hidden" class="form-control col-md-6" name="name" value="{{$user->name}}">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="email">Email:</label>
                    <label class="col-md-6">{{$user->email}}</label>
                    <input type="hidden" class="form-control col-md-6" name="email" value="{{$user->email}}">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="type">Type:</label>
                    @if ($user->type == 0) <label class="col-md-6">Admin</label>
                        @else <label class="col-md-6">User</label>
                    @endif
                    <input type="hidden" class="form-control col-md-6" name="type" value="{{$user->type}}">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="phone">Phone:</label>
                    <label class="col-md-6">{{$user->phone}}</label>
                    <input type="hidden" class="form-control col-md-6" name="phone" value="{{$user->phone}}">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="dob">Date of Birth:</label>
                    <label class="col-md-6">{{date('d-m-Y', strtotime($user->dob))}}</label>
                    <input type="hidden" class="form-control col-md-6" name="dob" value="{{$user->dob}}">
                </div>

                <div class="form-group row">
                    <label class="control-label col-md-4" for="address">Address:</label>
                    <label class="col-md-6">{{$user->address}}</label>
                    <input type="hidden" class="form-control col-md-6" name="address" value="{{$user->address}}">
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
