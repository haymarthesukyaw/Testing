<?php

namespace App\Contracts\Services\Post;
use App\Models\Post;

interface PostServiceInterface
{
//get Post list
public function getPost($authId, $type);
//get Post detail
//public function editPost($id);
public function postDetail($post_id);
public function store($auth_id, $post);
public function update($user_id, $post);
public function searchPost($search_keyword, $auth_id, $auth_type);
// public function softDelete($auth_id, $post_id);
public function softDelete(Post $post);
}
