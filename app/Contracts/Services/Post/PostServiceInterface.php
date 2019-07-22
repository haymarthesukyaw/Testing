<?php

namespace App\Contracts\Services\Post;
use App\Models\Post;

interface PostServiceInterface
{
public function getPost($authId, $type);
public function postDetail($post_id);
public function store($auth_id, $post);
public function update($user_id, $post);
public function searchPost($search_keyword, $auth_id, $auth_type);
public function softDelete($auth_id, $post_id);
}
