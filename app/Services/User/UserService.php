<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;

class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * Get Users List
   * @param Object
   * @return $users
   */
  public function getUser()
  {
    return $this->userDao->getUser();
  }

  /**
   * Create User
   * @param Object
   * @return $users
   */
  public function store($auth_id, $user)
  {
    return $this->userDao->store($auth_id, $user);
  }

  /**
   * Get Users List
   * @param Object
   * @return $users
   */
  public function searchUser($name, $email, $date_from, $date_to)
  {
    return $this->userDao->searchUser($name, $email, $date_from, $date_to);
  }

  /**
   * Get User detail
   * @param Object
   * @return $userDetail
   */
  public function userDetail($user_id)
  {
    return $this->userDao->userDetail($user_id);
  }

  /**
   * Update User
   * @param Object
   * @return $users
   */
  public function update($auth_id, $user)
  {
    return $this->userDao->update($auth_id, $user);
  }

  /**
   * Update User, Change Password
   * @param Object
   * @return $users
   */
  public function changePassword($auth_id, $user_id, $old_pwd, $new_pwd)
  {
    return $this->userDao->changePassword($auth_id, $user_id, $old_pwd, $new_pwd);
  }

  /**
   * Soft Delete User
   * @param Object
   * @return $users
   */
  public function softDelete($auth_id, $user_id)
  {
    return $this->userDao->softDelete($auth_id, $user_id);
  }
}
