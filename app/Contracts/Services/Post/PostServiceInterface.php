<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
//get Post list
public function getPost($authId, $type);
//get Post detail
//public function editPost($id);
}
