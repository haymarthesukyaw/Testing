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
use Excel;
use App\Exports\ExportPosts;
use App\Imports\ImportPosts;
use Log;
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
    //Excel Upload Form
    public function showUploadForm()
    {
        return view('post.upload');
    }

    //Excel Import Form
    // public function import(Request $request)
    // {
    //     $auth_id   = Auth::user()->id;
    //     $validator = Validator::make($request->all(), [
    //         'file' => 'required|max:2048'
    //     ]);
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator);
    //     }
    //     $file = $request->file('file');
    //     //validate type of file
    //     $extension = $file->getClientOriginalExtension();
    //     if ($extension != 'csv') {
    //         return redirect()->back()->withInvalid('The file must be a file of type: csv.');
    //     }
    //     //upload csv file
    //     $fileName = $file->getClientOriginalName();
    //     $file->move('upload', $fileName);
    //     $filepath = public_path() . '/upload/' . $fileName;
    //     $import_csv_file = $this->postService->import($auth_id, $filepath);
    //     return redirect()->route('posts.index');
    // }

    //Excel Import Form
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $file=$request->file('file');
        $extension = $file->getClientOriginalExtension();
        if ($extension != 'csv') {
            return redirect()->back()->withInvalid('The file must be a file of type: csv.');
        }
        Excel::import(new ImportPosts, $file);
        return redirect()->route('posts.index');
    }

    //Excel Export
    public function export()
    {
        return Excel::download(new ExportPosts, 'posts.xlsx');
    }

    //Get Posts
    public function index()
    {
        $auth_id = Auth::user()->id;
        $type    = Auth::user()->type;
        // session()->forget([
        //     'searchKeyword',
        //     'title',
        //     'desc'
        // ]);
        $posts = $this->postService->getPost($auth_id, $type);
        return view('post.postList',compact('posts'));
    }

    //Post Create Form
    public function createForm()
    {
        return view('post.create');
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
        return redirect()->route('posts.index');
        // return view('post.postList',compact('posts'))->withSuccess('Post create successfully.');
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
    public function show(Request $request)
    {
        $post = Post::findOrFail($request->id);
        $title=$post->title;
        $desc=$post->description;
        return response()->json(array('title'=>$title,'desc'=>$desc));
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
        return redirect()->route('posts.index');
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
        return redirect()->route('posts.index');
    }
}
