<?php

namespace Blog\Policies;

use Blog\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
   /**
   * Определение, может ли профиль редактироваться текущим пользователем.
   * @param  \Blog\User  $user
   * @return bool
   */
  public function update(User $currentUser, User $user)
  {
    if($user->id == $currentUser->id){
        return true;
    }
    else{
        return false;
    }
  }
}
