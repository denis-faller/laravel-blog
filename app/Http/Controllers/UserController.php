<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Models\User;
use Illuminate\Support\Facades\Auth;
use Blog\Services\UserService;
use Blog\Http\Requests\UserRequest;
use Blog\Services\RoleService;
use Blog\Models\Role;

/** 
 * Контроллер для вывода профиля пользователя
 */
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
    * Возвращает представление страницы пользователей
    * @return Illuminate\Support\Facades\View
    */  
    public function index(UserService $userService)
    {
        $this->authorize('index', User::class);
        $paginateUsers = $userService->paginated(9);
        
        $users = $paginateUsers->all();
        $title = 'Пользователи блога';
        $description = 'Все пользователи блога';
        
        return view('users.index', ['title' => $title, 
           'description' => $description,
            'users' => $users,
            'paginateUsers' => $paginateUsers]);
    }
    
    
    /**
    * Возвращает представление страницы профиля
    * @param User $user
    * @return Illuminate\Support\Facades\View
    */  
    public function show(User $user, RoleService $roleService)
    {
        $this->authorize('show', $user);
        
        $roles = $roleService->all();
        
        $userRolesIDs = array();
        foreach($user->roles as $role){
            $userRolesIDs[] = $role->id;
        }
        
        $currentUserRolesIDs = array();
        foreach(Auth::user()->roles as $role){
            $currentUserRolesIDs[] = $role->id;
        }
        
        $roleAdminID = Role::ROLE_ADMIN;
        
        $title = 'Профиль '.$user->name;
        $description = 'Профиль пользователя '.$user->name;
        return view('users.profile', ['title' => $title, 
           'description' => $description,
           'user' => $user,
           'roles' => $roles,
           'userRolesIDs' => $userRolesIDs,
           'currentUserRolesIDs' => $currentUserRolesIDs,
           'roleAdminID' => $roleAdminID]);
    }
    
    /**
    * Обновляет пользователя
    * @param User $user
    * @param Request $request
    * @param UserService $userService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(User $user, UserRequest $request, UserService $userService, RoleService $roleService)
    {
        $this->authorize('update', $user);
        
        if(isset($request->image)){
            $imageName = $request->image->hashName();

            $request->image->move(public_path('assets/images'), $imageName);

            $imagePath = '/assets/images/'.$imageName;
            
            $userUpdated = $userService->update($user->id, array('name' => $request->name, 'description' => $request->description, 'img' => $imagePath));
        }
        else{
            $userUpdated = $userService->update($user->id, array('name' => $request->name, 'description' => $request->description));
        }
        
        if(isset($userUpdated->id)){
            if(isset($request->roles)){
                $userUpdated->roles()->sync($request->roles);
            }
            return redirect(route('users.show', $user->id));
        }
    }
}
