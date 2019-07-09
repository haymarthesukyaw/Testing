@extends('layouts.layout')

@section('content')
<div id="editUser">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col">
            <h5>Update User</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="col-md-8 mx-auto">
                <div class="text-center mb-4">
                    <img width="100px" height="80px" src="" alt="User-profile" class="img-thumbnail">
                </div>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group row">
                    <label for="name" class="col-md-4">Name</label>
                    <input type="text" id="name" name="user_name" class="form-control col-md-6">
                    @if ($errors->has('user_name'))
                        <div class="col-md-4"></div>
                        <div class="col-md-6 mt-1 text-danger">{{ $errors->first('user_name') }}</div>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4">Email Address</label>
                    <input type="text" id="email" name="email" class="form-control col-md-6">
                    @if ($errors->has('email'))
                        <div class="col-md-4"></div>
                        <div class="col-md-6 mt-1 text-danger">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="type" class="col-md-4">Type</label>
                    <select name="type" id="type" class="col-md-6">
                        <option value="" disabled selected>Choose Type</option>
                        <option value="0">Admin</option>
                        <option value="1">User</option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-md-4">Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control col-md-6">
                    @if ($errors->has('phone'))
                        <div class="col-md-4"></div>
                        <div class="col-md-6 mt-1 text-danger">{{ $errors->first('phone') }}</div>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="dob" class="col-md-4">Date of Birth</label>
                    <input type="date" id="dob" name="dob" class="form-control col-md-6">
                </div>
                <div class="form-group row">
                    <label for="address" class="col-md-4">Address</label>
                    <textarea name="address" id="address" class="form-control col-md-6"></textarea>
                    @if ($errors->has('address'))
                        <div class="col-md-4"></div>
                        <div class="col-md-6 mt-1 text-danger">{{ $errors->first('address') }}</div>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="profile_photo" class="col-md-4">Profile</label>
                    <input type="file" name="profile_photo" class="form-control-file col-md-6" id="profile_photo">
                    @if ($errors->has('profile_photo'))
                        <div class="col-md-4"></div>
                        <div class="col-md-6 mt-1 text-danger">{{ $errors->first('profile_photo') }}</div>
                    @endif
                </div>
                <div class="form-group row">
                    <!-- <a href="{{route('password',['id' => 1])}}" class="btn btn-link form-control col-md-3">Change Password</a> -->
                    <a href="{{url('/changePwd')}}" class="btn btn-link form-control col-md-3">Change Password</a>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mr-4">Confirm</button>
                        <button type="reset" class="btn btn-dark">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
