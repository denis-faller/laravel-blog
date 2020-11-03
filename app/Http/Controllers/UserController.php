<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Models\User;
use Illuminate\Support\Facades\Auth;
use Blog\Services\UserService;
use Blog\Http\Requests\UserRequest;
use Blog\Services\RoleService;
use Blog\Models\Role;
use Blog\Models\Site;
use Illuminate\Support\Facades\Hash;

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
    * @param UserService $userService
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
    * Возвращает представление страницы создания пользователя
    * @param UserService $userService
    * @param RoleService $roleService 
    * @return Illuminate\Support\Facades\View
    */  
    public function create(UserService $userService, RoleService $roleService)
    {
        $this->authorize('create', User::class);
        
        $roles = $roleService->all();
       
        $currentUserRolesIDs = array();
        foreach(Auth::user()->roles as $role){
            $currentUserRolesIDs[] = $role->id;
        }
        
        $roleAdminID = Role::ROLE_ADMIN;
        
        $title = 'Создание нового пользователя';
        $description = 'Создание нового пользователя блога';
        return view('users.create', ['title' => $title, 
           'description' => $description,         
           'roles' => $roles,
           'currentUserRolesIDs' => $currentUserRolesIDs,
           'roleAdminID' => $roleAdminID]);
    }
    
    /**
    * Создает пользователя
    * @param UserRequest $request
    * @param UserService $userService
    * @param RoleService $roleService 
    * @return Illuminate\Routing\Redirector
    */  
    public function store(UserRequest $request, UserService $userService, RoleService $roleService)
    {
        $this->authorize('store', User::class);
        
        if(isset($request->image)){
            $imageName = $request->image->hashName();

            $request->image->move(public_path('assets/images'), $imageName);

            $imagePath = '/assets/images/'.$imageName;
            
            $userCreated = $userService->create(array('site_id' => Site::MAIN_SITE_ID, 'name' => $request->name, 'description' => $request->description, 'email' => $request->email, 'password' => Hash::make($request->password), 'img' => $imagePath));
        }
        else{
            $userCreated = $userService->create(array('site_id' => Site::MAIN_SITE_ID, 'name' => $request->name, 'description' => $request->description, 'email' => $request->email, 'password' => Hash::make($request->password)));
        }
        
        if(isset($userCreated->id)){
            if(isset($request->roles)){
                $userCreated->roles()->sync($request->roles);
            }
            return redirect(route('users.show', $userCreated->id));
        }
    }
    
    /**
    * Возвращает представление страницы профиля
    * @param User $user
    * @param RoleService $roleService
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
    * @param UserRequest $request
    * @param UserService $userService
    * @param RoleService $roleService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(User $user, UserRequest $request, UserService $userService, RoleService $roleService)
    {
        $this->authorize('update', $user);
        
        $password = "";
        
        // Если поле пароль пустое, значит пароль не менялся
        if(empty($request->password)){
            $password = $user->password;
        }
        else{
            $password = Hash::make($request->password);
        }
        
        if(isset($request->image)){
            $imageName = $request->image->hashName();

            $request->image->move(public_path('assets/images'), $imageName);

            $imagePath = '/assets/images/'.$imageName;
            
            $userUpdated = $userService->update($user->id, array('name' => $request->name, 'description' => $request->description, 'email' => $request->email, 'password' => $password, 'img' => $imagePath));
        }
        else{
            $userUpdated = $userService->update($user->id, array('name' => $request->name, 'description' => $request->description, 'email' => $request->email, 'password' => $password));
        }
        
        if(isset($userUpdated->id)){
            if(isset($request->roles)){
                $userUpdated->roles()->sync($request->roles);
            }
            return redirect(route('users.show', $user->id));
        }
    }
    
    /**
    * Удаляет пользователя
    * @param User $user
    * @param UserService $userService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(User $user, UserService $userService)
    {
        $this->authorize('destroy', $user);
        
        $isDelete = $userService->destroy($user->id);
        
        if($isDelete){
            return redirect(route('users.index'));
        }
    }
}
