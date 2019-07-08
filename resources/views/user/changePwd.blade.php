@extends('layouts.layout')

@section('content')
<div id="changePassword">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col">
            <h5>Change Password</h5>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="/changePwd" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group row">
                    <label for="old_password" class="col-md-4">Old password</label>
                    <input type="password" id="old_password" name="old_password" class="form-control col-md-6">
                    @if ($errors->has('old_password'))
                        <div class="col-md-4"></div>
                        <div class="col-md-6 mt-1 text-danger">{{ $errors->first('old_password') }}</div>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-4">New password</label>
                    <input type="password" id="password" name="password" class="form-control col-md-6">
                    @if ($errors->has('password'))
                        <div class="col-md-4"></div>
                        <div class="col-md-6 mt-1 text-danger">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4">Confirm new password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control col-md-6">
                    @if ($errors->has('password_confirmation'))
                        <div class="col-md-4"></div>
                        <div class="col-md-6 mt-1 text-danger">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary  mr-4">Confirm</button>
                        <button type="reset" class="btn btn-dark">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
