<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;

class PostService implements PostServiceInterface
{
  private $postDao;

  /**
   * Class Constructor
   * @param OperatorPostDaoInterface
   * @return
   */
  public function __construct(PostDaoInterface $postDao)
  {
    $this->postDao = $postDao;
  }

  /**
   * Get Posts List
   * @param Object
   * @return $posts
   */
  public function getPost($auth_id, $type)
  {
    return $this->postDao->getPost($auth_id, $type);
  }

  /**
   * Create Post
   * @param Object
   * @return $posts
   */
  public function store($auth_id, $post)
  {
    return $this->postDao->store($auth_id, $post);
  }

  /**
   * Get Post detail
   * @param Object
   * @return $postDetail
   */
  public function postDetail($post_id)
  {
    return $this->postDao->postDetail($post_id);
  }

  /**
   * Update Post
   * @param Object
   * @return $posts
   */
  public function update($user_id, $post)
  {
    return $this->postDao->update($user_id, $post);
  }

  /**
   * Get Posts List
   * @param Object
   * @return $posts
   */
  public function searchPost($search_keyword, $auth_id, $auth_type)
  {
    return $this->postDao->searchPost($search_keyword, $auth_id, $auth_type);
  }

  /**
   * Import csf file
   * @param Object
   * @return $posts
   */
  public function import($auth_id, $filepath)
  {
    return $this->postDao->import($auth_id, $filepath);
  }

  /**
   * Soft Delete Post
   * @param Object
   * @return $posts
   */
  public function softDelete($auth_id, $post_id)
  {
    return $this->postDao->softDelete($auth_id, $post_id);
  }
}
