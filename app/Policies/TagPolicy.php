<?php

namespace Blog\Policies;

use Blog\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Blog\Models\Role;

class TagPolicy
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
   * Определение, может ли текущий пользователь просматривать страницу тегов
   * @param  \Blog\User  $currentUser
   * @return bool
   */
  public function index(User $currentUser)
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
   * Определение, может ли текущий пользователь просматривать страницу создания тега
   * @param  \Blog\User  $currentUser
   * @return bool
   */
  public function create(User $currentUser)
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
   * Определение, может ли текущий пользователь создавать новый тег
   * @param  \Blog\User  $currentUser
   * @return bool
   */
  public function store(User $currentUser)
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
   * Определение, может ли тег просматриваться текущим пользователем
   * @param  \Blog\User  $currentUser
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
   * Определение, может ли тег редактироваться текущим пользователем
   * @param  \Blog\User  $currentUser
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
  
      
   /**
   * Определение, может ли текущий пользователь удалять тег
   * @param  \Blog\User  $currentUser
   * @return bool
   */
  public function destroy(User $currentUser)
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
