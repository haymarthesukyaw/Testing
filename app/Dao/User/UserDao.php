<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use App\Models\Post;
use Hash;

class UserDao implements UserDaoInterface
{
  /**
   * Get Users List
   * @param Object
   * @return $users
   */
  public function getUser()
  {
    $users = User::select(
      'users.name',
      'users.email',
      'users.phone',
      'users.dob',
      'users.address',
      'users.created_at',
      'users.updated_at',
      'users.id',
      'u1.name as created_user_name')
      ->join('users as u1', 'u1.id', 'users.create_user_id')
      ->orderBy('users.updated_at', 'DESC')
      ->paginate(50);
    return $users;
  }

  /**
   * Create Post
   * @param Object
   * @return $posts
   */
  public function store($auth_id, $user)
  {
    $insert_user = new User([
      'name'            =>  $user->name,
      'email'           =>  $user->email,
      'password'        =>  $user->password,
      'profile'         =>  $user->profile,
      'type'            =>  $user->type,
      'phone'           =>  $user->phone,
      'address'         =>  $user->address,
      'dob'             =>  $user->dob,
      'create_user_id'  =>  $auth_id,
      'updated_user_id' =>  $auth_id
    ]);
    $insert_user->save();
    return redirect()->back();
  }
}
