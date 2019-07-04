<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Models\Post;

class PostDao implements PostDaoInterface
{
  /**
   * Get Posts List
   * @param Object
   * @return $posts
   */
  public function getPost($auth_id, $type)
  {
    if ($type == '0') {
      $posts = Post::orderBy('updated_at', 'DESC')->paginate(50);
    } else {
      $posts = Post::where('create_user_id', $auth_id)
        ->orderBy('updated_at', 'DESC')
        ->paginate(50);
    }
    return $posts;
  }
}
