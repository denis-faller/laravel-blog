<?php

namespace Blog\Policies;

use Blog\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Blog\Models\Role;

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
   * Определение, может ли профиль просматриваться страницу пользователей
   * @param  \Blog\User  $currentUser
   * @return bool
   */
  public function index(User $currentUser)
  {
        $currentUserRolesIDs = array();
        foreach($currentUser->roles as $role){
            $currentUserRolesIDs[] = $role->id;
        }
        if(in_array(Role::ROLE_ADMIN, $currentUserRolesIDs)){
            return true;
        }
        else{
            return false;
        }
  }
  
   /**
   * Определение, может ли текущий пользователь просматривать страницу создания пользователя
   * @param  \Blog\User  $currentUser
   * @return bool
   */
  public function create(User $currentUser)
  {
        $currentUserRolesIDs = array();
        foreach($currentUser->roles as $role){
            $currentUserRolesIDs[] = $role->id;
        }
        if(in_array(Role::ROLE_ADMIN, $currentUserRolesIDs)){
            return true;
        }
        else{
            return false;
        }
  }
    
   /**
   * Определение, может ли текущий пользователь создавать нового пользователя
   * @param  \Blog\User  $currentUser
   * @return bool
   */
  public function store(User $currentUser)
  {
        $currentUserRolesIDs = array();
        foreach($currentUser->roles as $role){
            $currentUserRolesIDs[] = $role->id;
        }
        if(in_array(Role::ROLE_ADMIN, $currentUserRolesIDs)){
            return true;
        }
        else{
            return false;
        }
  }
  
    /**
   * Определение, может ли профиль просматриваться текущим пользователем
   * @param  \Blog\User  $currentUser
   * @param  \Blog\User  $user
   * @return bool
   */
  public function show(User $currentUser, User $user)
  {
        $currentUserRolesIDs = array();
        foreach($currentUser->roles as $role){
            $currentUserRolesIDs[] = $role->id;
        }
        if($user->id == $currentUser->id || in_array(Role::ROLE_ADMIN, $currentUserRolesIDs)){
            return true;
        }
        else{
            return false;
        }
  }
    
   /**
   * Определение, может ли профиль редактироваться текущим пользователем
   * @param  \Blog\User  $currentUser
   * @param  \Blog\User  $user
   * @return bool
   */
  public function update(User $currentUser, User $user)
  {
        $currentUserRolesIDs = array();
        foreach($currentUser->roles as $role){
            $currentUserRolesIDs[] = $role->id;
        }
        if($user->id == $currentUser->id || in_array(Role::ROLE_ADMIN, $currentUserRolesIDs)){
            return true;
        }
        else{
            return false;
        }
  }
  
      
   /**
   * Определение, может ли текущий пользователь удалять определенного пользователя
   * @param  \Blog\User  $currentUser
   * @return bool
   */
  public function destroy(User $currentUser)
  {
        $currentUserRolesIDs = array();
        foreach($currentUser->roles as $role){
            $currentUserRolesIDs[] = $role->id;
        }
        if(in_array(Role::ROLE_ADMIN, $currentUserRolesIDs)){
            return true;
        }
        else{
            return false;
        }
  }
}
