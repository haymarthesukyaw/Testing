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
        <form action="/users/search" method="GET" class="form-inline">
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
                    <td><button class="btn btn-link" data-target="#show" data-toggle="modal" id="show_user" data-showid="{{$user->id}}">{{$user->name}}</button></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_user_name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{date('d-m-Y', strtotime($user->dob))}}</td>
                    <td>{{$user->address}}</td>
                    <td>{{$user->created_at->format('d-m-y')}}</td>
                    <td>{{$user->updated_at->format('d-m-y')}}</td>
                    <td><a href="/user/{{$user->id}}">edit</a></td>
                    <td><a href="#deleteConfirmModal" class="btn btn-danger userDelete" onclick="deleteUser({{$user->id}})"
                    data-toggle="modal">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
        </table>
        <ul class="pagination col-md-12 justify-content-center">
            {{$users->links()}}
        </ul>
    </div>
</div>
<!-- Show User Detail Modal -->
<div class="modal fade" id="show" role="dialog">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="post-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <label class="col-md-3">Name:</label>
                <label class="userName col-md-6"></label>
                <label class="col-md-3">Email:</label>
                <label class="userEmail col-md-6"></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- User Delete Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" class="deleteForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p>Are you sure want to delete this post?</p>
                    <input type="hidden" id="user_id" name="user_id" class="userID" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- User Delete Script -->
<script type="text/javascript">
    function deleteUser(id)
    {
        var id = id;
        var url = "/user/"+id;
        $(".deleteForm").attr('action', url);
        $(".userID").attr('value',id);
    }
</script>

<!-- Show User Detail Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click','#show_user',function(){
        var id=$(this).data('showid');
        console.log(id);
        $.post('/showUser',{'_token':$('input[name=_token]').val() ,id:id},function(data){
            $('.modal-title').text('User Detail');
            $('.userName').text(data.name);
            $('.userEmail').text(data.email);
        });
    });
</script>
@endsection
