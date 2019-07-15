@extends('layouts.layout')

@section('content')
<div id="userList">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col">
            <h5>User List</h5>
        </div>
    </div>

    <div class="row justify-content-center">
        <form action="/posts/search" method="GET" class="form-inline">
        @csrf
            <div class="form-group mb-2">
            <div class="pb-4">
                <input type="text" name="name" value="{{session('searchKeyword')}}" class="form-control form-control-md mb-6 mr-4" placeholder="Name">
                <input type="text" name="email" value="{{session('searchKeyword')}}" class="form-control form-control-md mb-6 mr-4" placeholder="Email">
                <input type="text" name="createdFrom" value="{{session('searchKeyword')}}" class="form-control form-control-md mb-6 mr-4" placeholder="CreatedFrom">
                <input type="text" name="createdTo" value="{{session('searchKeyword')}}" class="form-control form-control-md mb-6 mr-4" placeholder="CreatedTo">
                <button type="submit" class="btn btn-primary btn-md mb-6 mr-4">Search</button>
                <a href="/user/create" class="btn btn-primary btn-md mb-6 mr-4">Add</a>
            </div>
            </div>
        </form>
    </div>

    <div class="container">
        <table class="table table-md table-bordered text-center">
        <thead class="thead-light">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created User</th>
                <th scope="col">Phone</th>
                <th scope="col">Birth Date</th>
                <th scope="col">Address</th>
                <th scope="col">Created Date</th>
                <th scope="col">Updated Date</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $user)
            <tr>
                    <td><a href="">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_user_name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{date('d-m-Y', strtotime($user->dob))}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->created_at->format('d-m-y')}}</td>
                    <td>{{$user->updated_at->format('d-m-y')}}</td>
                    <td><a href="/user/edit">edit</a></td>
                    <td><a href=>delete</a></td>
            </tr>
            @endforeach
        </tbody>
        </table>
        <ul class="pagination col-md-12 justify-content-center">
            {{$users->links()}}
        </ul>
    </div>
</div>
@endsection
