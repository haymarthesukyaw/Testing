<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Services\Post\PostService;
use Auth;
use Validator;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $postService;

    public function __construct(PostServiceInterface $post)
    {
        $this->postService = $post;
    }

    public function createForm()
    {
        return view('post.create');
    }

    public function showUploadForm()
    {
        return view('post.upload');
    }
    public function import()
    {
        return view('post.postList');
    }
    public function index()
    {
        $auth_id = Auth::user()->id;
        $type    = Auth::user()->type;
        session()->forget([
            'searchKeyword',
            'title',
            'desc'
        ]);
        $posts = $this->postService->getPost($auth_id, $type);
        return view('post.postList',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' =>  'required|max:255|unique:posts,title',
            'desc'  =>  'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $title  =  $request->title;
        $desc   =  $request->desc;
        session([
            'title' => $title,
            'desc'  => $desc
        ]);
        return view('post.createConfirm',compact('title','desc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth_id =  Auth::user()->id;
        $post    =  new Post;
        $post->title = $request->title;
        $post->desc  = $request->desc;
        $posts   =  $this->postService->store($auth_id, $post);
        return view('post.postList',compact('posts'))->withSuccess('Post create successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $auth_id   = Auth::user()->id;
        $auth_type = Auth::user()->type;
        $search_keyword = $request->search;
        $posts     = $this->postService->searchPost($search_keyword, $auth_id, $auth_type);
        session ([
            'searchKeyword' => $search_keyword
        ]);
        return view('post.postlist', compact('posts'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $post = Post::findOrFail($post_id);
        $title=$post->title;
        $desc=$post->description;
        // $user = User::where('id', '=', $post->create_user_id)
        //     ->select('name')
        //     ->first();
        // return response()->json(['post' => $post]);
        // return view('post.postList',compact('title','desc'));
        return view('post.postList')->with('post', json_decode($post, true));
        // return json_decode($post, true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = $this->postService->postDetail($id);
        return view('post.edit',compact('post'));
    }

    public function editConfirm(Request $request, $id)
    {
        $post   =   Post::find($id);
        $title  =   $request->title;
        $desc   =   $request->desc;
        $validator  = Validator::make($request->all(), [
            'title' =>  'required|max:255|unique:posts,title,' . $post->id,
            'desc'  =>  'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        // dd($title);
        // dd($desc);
        // dd($id);
        return view('post.update',compact('title','desc','id'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user_id  =  Auth::user()->id;
        $post     =  new Post;
        $post->id     =  $id;
        $post->title  =  $request->title;
        $post->desc   =  $request->desc;
        $posts    =  $this->postService->update($user_id, $post);
        // return view('post.postList', compact('posts'))->withSuccess('Post update successfully.');
        return redirect()->route('posts.index',compact('posts'))->withSuccess('Post update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $post_id = $request->post_id;
        $auth_id = Auth::user()->id;
        $delete_post=$this->postService->softDelete($auth_id, $post_id);
        // dd($delete_post);
        return redirect()->route('posts.index');

    }
    // public function export()
    // {
    //     return Excel::download(new PostsExport, 'posts.xlsx');
    // }
}
