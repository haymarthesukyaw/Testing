@extends('layouts.layout')

@section('content')
<div id="postList">
    <div class="row mb-3">
        <div class="col-md-3"></div>
        <div class="col-md-16">
            <h5>Post List</h5>
        </div>
    </div>

    <div class="row justify-content-center">
        <form action="/posts/search" method="GET" class="form-inline">
        @csrf
            <div class="form-group mb-2">
                <input type="text" name="search" value="{{session('searchKeyword')}}" class="form-control form-control-lg mb-6 mr-4" placeholder="Search...">
                <button type="submit" class="btn btn-primary btn-lg mb-6 mr-4">Search</button>
                <a href="/post/create" class="btn btn-primary btn-lg mb-6 mr-4">Add</a>
                <a href="/csv/upload" class="btn btn-primary btn-lg mb-6 mr-4">Upload</a>
                <a href="/download" class="btn btn-primary btn-lg mb-6 mr-4">Download</a>
            </div>
        </form>
    </div>

    <div class="container-fluid">
        <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th scope="col">Post Title</th>
                <th scope="col">Post Description</th>
                <th scope="col">Posted User</th>
                <th scope="col">Posted Date</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td>User</td>
                    <td>date</td>
                    <td><a href="/post/edit">edit</a></td>
                    <td>delete</td>
            </tr>
            <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td>User</td>
                    <td>date</td>
                    <td>edit</td>
                    <td>delete</td>
            </tr>
            <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td>User</td>
                    <td>date</td>
                    <td>edit</td>
                    <td>delete</td>
            </tr>
            <tr>
                    <td>Title</td>
                    <td>Description</td>
                    <td>User</td>
                    <td>date</td>
                    <td>edit</td>
                    <td>delete</td>
            </tr>
        </tbody>
        </table>
    </div>
</div>
@endsection
