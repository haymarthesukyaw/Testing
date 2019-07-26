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
      ->paginate(5);
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
    // return redirect()->back();
    $users = User::where('create_user_id', $auth_id)
      ->orderBy('updated_at', 'DESC')
      ->paginate(5);
    return $users;
  }

    /**
   * Get Users List
   * @param Object
   * @return $users
   */
  public function searchUser($name, $email, $date_from, $date_to)
  {
    //All Null
    if ($name == null && $email == null && $date_from == null && $date_to == null) {
        $users = User::select(
          'users.name',
          'users.email',
          'users.phone',
          'users.dob',
          'users.address',
          'users.created_at',
          'users.updated_at',
          'u1.name as created_user_name')
          ->join('users as u1', 'u1.id', 'u1.create_user_id')
          ->orderBy('users.updated_at', 'DESC')
          ->paginate(5);
      }
    else {
        //Name OR Email And Date Null
        if ((isset($name) || isset($email)) &&
            (is_null($date_from) && is_null($date_to))) {
                $users = User::select(
                    'users.name',
                    'users.email',
                    'users.phone',
                    'users.dob',
                    'users.address',
                    'users.created_at',
                    'users.updated_at',
                    'u1.name as created_user_name')
                    ->where('users.name', 'LIKE', '%' . $name . '%')
                    ->where('users.email', 'LIKE', '%' . $email . '%')
                    ->join('users as u1', 'u1.id', 'u1.create_user_id')
                    ->orderBy('users.updated_at', 'DESC')
                    ->paginate(5);
        }
        //Name OR Email OR Date
        elseif ((isset($name) || isset($email)) ||
            (isset($date_from) && isset($date_to))) {
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
                    ->where('users.name', 'LIKE', '%' . $name . '%')
                    ->where('users.email', 'LIKE', '%' . $email . '%')
                    ->where('users.created_at', '>=', $date_from)
                    ->where('users.created_at', '<=',$date_to)
                    ->orderBy('users.updated_at', 'DESC')
                    ->paginate(5);
        }
    }
      return $users;
    // if ($name == null && $email == null && $date_from == null && $date_to == null) {
    //   $users = User::select(
    //     'users.name',
    //     'users.email',
    //     'users.phone',
    //     'users.dob',
    //     'users.address',
    //     'users.created_at',
    //     'users.updated_at',
    //     'users.id',
    //     'u1.name as created_user_name')
    //     ->join('users as u1', 'u1.id', 'users.create_user_id')
    //     ->orderBy('users.updated_at', 'DESC')
    //     ->paginate(5);
    // } else {
    //     if ((isset($name) || isset($email)) &&
    //         (is_null($date_from) && is_null($date_to))) {
    //             $users = User::select(
    //               'users.name',
    //               'users.email',
    //               'users.phone',
    //               'users.dob',
    //               'users.address',
    //               'users.created_at',
    //               'users.updated_at',
    //               'users.id',
    //               'u1.name as created_user_name')
    //               ->where('users.name', 'LIKE', '%' . $name . '%')
    //               ->where('users.email', 'LIKE', '%' . $email . '%')
    //               ->join('users as u1', 'u1.id', 'users.create_user_id')
    //               ->orderBy('users.updated_at', 'DESC')
    //               ->paginate(5);
    //     } elseif ((isset($name) || isset($email)) ||
    //         (isset($date_from) && isset($date_to))) {
    //             $users = User::select(
    //               'users.name',
    //               'users.email',
    //               'users.phone',
    //               'users.dob',
    //               'users.address',
    //               'users.created_at',
    //               'users.updated_at',
    //               'users.id',
    //               'u1.name as created_user_name')
    //               ->join('users as u1', 'u1.id', 'users.create_user_id')
    //               ->where('users.name', 'LIKE', '%' . $name . '%')
    //               ->where('users.email', 'LIKE', '%' . $email . '%')
    //               ->whereBetween('users.created_at', array($date_from, $date_to))
    //               ->orderBy('users.updated_at', 'DESC')
    //               ->paginate(5);
    //     }
    // }
    // return $users;
  }

  /**
   * Get User detail
   * @param Object
   * @return $userDetail
   */
  public function userDetail($user_id)
  {
    return $user_detail = User::find($user_id);
  }

  /**
   * Update User
   * @param Object
   * @return $users
   */
  public function update($auth_id, $user)
  {
    if ($user->profile == null) {
      $user->profile = "";
    }
    $update_user = User::find($user->id);
    $update_user->name = $user->name;
    $update_user->email = $user->email;
    $update_user->profile = $user->profile;
    $update_user->type = $user->type;
    $update_user->phone = $user->phone;
    $update_user->address = $user->address;
    $update_user->dob = $user->dob;
    $update_user->updated_user_id = $auth_id;
    $update_user->updated_at = now();
    $update_user->save();
    return redirect()->back();
  }

  /**
   * Update User, Change Password
   * @param Object
   * @return $users
   */
  public function changePassword($auth_id, $user_id, $old_pwd, $new_pwd)
  {
    $update_user = User::find($user_id);
    $update_user->password   = Hash::make($new_pwd);
    $update_user->updated_user_id = $auth_id;
    $update_user->updated_at = now();
    $update_user->save();
    return redirect()->back();
    // $status = Hash::check($old_pwd, $update_user->password);
    // $status1= strcmp($old_pwd,$new_pwd);
    // if ($status1 == 0) {
    //     $status="ERROR";

    // }
    // else{
    //     if ($status) {
    //         $update_user->password   = Hash::make($new_pwd);
    //         $update_user->updated_user_id = $auth_id;
    //         $update_user->updated_at = now();
    //         $update_user->save();
    //     }
    // return $status;
    // }
    // $status = Hash::check($old_pwd, $update_user->password);
    // if ($status) {
        // $update_user->password   = Hash::make($new_pwd);
        // $update_user->updated_user_id = $auth_id;
        // $update_user->updated_at = now();
        // $update_user->save();
    // }
    // return $status;
  }

  /**
   * Soft Delete User
   * @param Object
   * @return $users
   */
  public function softDelete($auth_id, $user_id)
  {
    $user_delete = User::find($user_id);
    $user_delete->deleted_user_id = $auth_id;
    $user_delete->deleted_at = now();
    $user_delete->save();
    $postDelete = Post::where('create_user_id', '=', $user_id)
      ->update([
        'deleted_user_id' => $auth_id,
        'deleted_at'      => now()
      ]);
    return back();
  }
}
