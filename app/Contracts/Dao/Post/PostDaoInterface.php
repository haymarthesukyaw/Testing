<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
  //get post list
  public function getPost($authId, $type);
  //get Post detail
  //public function editPost($id);
}
