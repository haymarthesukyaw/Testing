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
        <form action="/search" method="POST" class="form-inline">
        @csrf
            <div class="form-group mb-2">
            <div class="pb-4">
                <input type="text" name="name" value="{{session('search_name')}}" class="form-control mb-6 mr-4" placeholder="Name">
                <input type="text" name="email" value="{{session('search_email')}}" class="form-control mb-6 mr-4" placeholder="Email">
                <input type="text" name="dateFrom" value="{{session('search_date_from')}}" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" class="form-control mb-6 mr-4" placeholder="Created From">
                <input type="text" name="dateTo" value="{{session('search_date_to')}}" onfocus="(this.type='date')" onblur="if(this.value==''){this.type='text'}" class="form-control mb-6 mr-4" placeholder="Created To">
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
                    <td><a href="/user/{{$user->id}}">edit</a></td>
                    <td><a href="#deleteConfirmModal" class="btn btn-danger userDelete"
                            data-toggle="modal" data-id="{{$user->id}}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
        </table>
        <ul class="pagination col-md-12 justify-content-center">
            {{$users->links()}}
        </ul>
    </div>

    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure want to delete this post?</p>
                </div>
                <div class="modal-footer">
                    <form action="/user" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" id="user_id" name="user_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
