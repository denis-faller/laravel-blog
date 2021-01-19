<?php

namespace Blog\Policies;

use Blog\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Blog\Models\Role;

class SitePolicy
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
    * Определение, может ли информация о сайте просматриваться текущим пользователем
    * @param  \Blog\User $currentUser
    * @return bool
    */
    public function show(User $currentUser)
    {
          $currentUserRolesIDs = array();
          foreach($currentUser->roles as $role){
              $currentUserRolesIDs[] = $role->id;
          }
          if(in_array(Role::ROLE_ADMIN, $currentUserRolesIDs) || in_array(Role::ROLE_CONTENT_MANAGER, $currentUserRolesIDs)){
              return true;
          }
          else{
              return false;
          }
    }

    /**
    * Определение, может ли информация о сайте редактироваться текущим пользователем
    * @param  \Blog\User $currentUser
    * @return bool
    */
    public function update(User $currentUser)
    {
          $currentUserRolesIDs = array();
          foreach($currentUser->roles as $role){
              $currentUserRolesIDs[] = $role->id;
          }
          if(in_array(Role::ROLE_ADMIN, $currentUserRolesIDs) || in_array(Role::ROLE_CONTENT_MANAGER, $currentUserRolesIDs)){
              return true;
          }
          else{
              return false;
          }
    }
}
