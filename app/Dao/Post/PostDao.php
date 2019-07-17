<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;
use Log;

class PostDao implements PostDaoInterface
{
    protected $post;
  public function __construct(Post $post)
  {
    $this->post=$post;
  }
  /**
   * Get Posts List
   * @param Object
   * @return $posts
   */
  public function getPost($auth_id, $type)
  {
    if ($type == '0') {
      $posts = Post::orderBy('updated_at', 'DESC')->paginate(5);
    } else {
      $posts = Post::where('create_user_id', $auth_id)
        ->orderBy('updated_at', 'DESC')
        ->paginate(5);
    }
    return $posts;
  }
  /**
   * Get Post detail
   * @param Object
   * @return $postDetail
   */
  public function postDetail($post_id)
  {
    return $post_detail = Post::findOrFail($post_id);
  }

  /**
   * Create Post
   * @param Object
   * @return $posts
   */
  public function store($auth_id, $post)
  {
    $insert_post = new Post([
      'title'           =>  $post->title,
      'description'     =>  $post->desc,
      'create_user_id'  =>  $auth_id,
      'updated_user_id' =>  $auth_id
    ]);
    $insert_post->save();
    $posts = Post::where('create_user_id', $auth_id)
      ->orderBy('updated_at', 'DESC')
      ->paginate(5);
    //   log::info('count');
    // log::info(count($posts));
      return $posts;
  }
/**
   * Update Post
   * @param Object
   * @return $posts
   */
  public function update($user_id, $post)
  {
    $update_post = Post::find($post->id);
    $update_post->title            =  $post->title;
    $update_post->description      =  $post->desc;
    $update_post->updated_user_id  =  $user_id;
    $update_post->updated_at       =  now();
    $update_post->save();
    $posts = Post::where('create_user_id', $user_id)
      ->orderBy('updated_at', 'DESC')
      ->paginate(5);
    return $posts;
  }
  /**
   * Get Posts List
   * @param Object
   * @return $posts
   */
  public function searchPost($search_keyword, $auth_id, $auth_type)
  {
    if ($auth_type == 0) {
      if ($search_keyword == null) {
        $posts = Post::orderBy('updated_at', 'DESC')->paginate(5);
      } else {
          $posts = Post::where('title', 'LIKE', '%' . $search_keyword . '%')
            ->orwhere('description', 'LIKE', '%' . $search_keyword . '%')
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);
      }
    } else {
        if ($search_keyword == null) {
          $posts = Post::where('create_user_id', '=', $auth_id)
            ->orderBy('updated_at', 'DESC')->paginate(5);
        } else {
            $posts = Post::where('title', 'LIKE', '%' . $search_keyword . '%')
              ->orwhere('description', 'LIKE', '%' . $search_keyword . '%')
              ->where('create_user_id', '=', $auth_id)
              ->orderBy('updated_at', 'DESC')
              ->paginate(5);
        }
    }
    return $posts;
  }

  /**
   * Soft Delete Post
   * @param Object
   * @return $posts
   */
    public function softDelete($auth_id,$post_id)
    {
        $delete_post=Post::findOrFail($post_id);
        $delete_post->deleted_user_id = $auth_id;
        $delete_post->deleted_at = now();
        $delete_post->save();
    }
}
