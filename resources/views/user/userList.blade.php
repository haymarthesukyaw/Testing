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
            <tr>
                    <td>User1</td>
                    <td>user1@gmail.com</td>
                    <td>User1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>10/05/2019</td>
                    <td>10/05/2019</td>
                    <td><a href="/user/edit">edit</a></td>
                    <td><a href=>delete</a></td>
            </tr>
            <tr>
                    <td>User1</td>
                    <td>user1@gmail.com</td>
                    <td>User1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>10/05/2019</td>
                    <td>10/05/2019</td>
                    <td>edit</td>
                    <td>delete</td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
@endsection
