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
                <a href="{{url('/csv/upload')}}" class="btn btn-primary btn-md mb-6 mr-4">Upload</a>
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
            @foreach($posts as $key => $post)
            <tr>
                <td><button class="btn btn-link" data-target="#show" data-toggle="modal" id="show_post" data-showid="{{$post->id}}">{{$post->title}}</button></td>
                <td>{{$post->description}}</td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->created_at->format('d-m-y')}}</td>
                <td><a href="/post/{{$post->id}}">edit</a></td>
                <td><a href="#deleteConfirmModal" class="btn btn-danger postDelete" onclick="deleteData({{$post->id}})"
                    data-toggle="modal">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
        </table>
        <ul class="pagination col-md-12 justify-content-center">
            {{$posts->links()}}
        </ul>
    </div>
</div>

<!-- Show Post Detail Modal -->
<div class="modal fade" id="show" role="dialog">
    <div class="modal-dialog" role="document" >
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="post-title"></h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <p class="postTitle"></p>
            <p class="postDesc"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Post Delete Modal -->
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
                    <input type="hidden" id="post_id" name="post_id" class="postID" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-danger" type="submit">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Post Delete Script -->
<script type="text/javascript">
    function deleteData(id)
    {
        var id = id;
        var url = "/post/"+id;
        $(".deleteForm").attr('action', url);
        $(".postID").attr('value',id);
    }
</script>

<!-- Show Post Detail Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('click','#show_post',function(){
        var id=$(this).data('showid');
        console.log(id);
        $.post('/showPost',{'_token':$('input[name=_token]').val() ,id:id},function(data){
            $('.modal-title').text('Post Detail');
            $('.postTitle').text(data.title);
            $('.postDesc').text(data.desc);
        });
    });
</script>

@endsection
