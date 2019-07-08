@extends('layouts.layout')

@section('content')
<div id="postList">
    <div class="row mb-3">
        <div class="col-md-1"></div>
        <div class="col">
            <h5>Post List</h5>
        </div>
    </div>

    <div class="row justify-content-center">
        <form action="/posts/search" method="GET" class="form-inline">
        @csrf
            <div class="form-group mb-2">
            <div class="pb-4">
                <input type="text" name="search" value="{{session('searchKeyword')}}" class="form-control form-control-md mb-6 mr-4" placeholder="Search...">
                <button type="submit" class="btn btn-primary btn-md mb-6 mr-4">Search</button>
                <a href="/post/create" class="btn btn-primary btn-md mb-6 mr-4">Add</a>
                <a href="/csv/upload" class="btn btn-primary btn-md mb-6 mr-4">Upload</a>
                <a href="/download" class="btn btn-primary btn-md mb-6 mr-4">Download</a>
            </div>
            </div>
        </form>
    </div>

    <div class="container">
        <table class="table table-md table-bordered text-center">
        <thead class="thead-light">
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
                    <td><button class="btn btn-link" data-toggle="modal" data-target="#title">Title</button></td>
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

<div class="modal fade" id="title" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" >
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Modal Header</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>This is a small modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
