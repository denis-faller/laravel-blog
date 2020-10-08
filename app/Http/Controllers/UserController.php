<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Models\User;
use Illuminate\Support\Facades\Auth;
use Blog\Services\UserService;
use Blog\Http\Requests\UserRequest;

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
    * Возвращает представление страницы профиля
    * @return Illuminate\Support\Facades\View
    */  
    public function index()
    {
        if(Auth::Check()){
            $user = Auth::user();
            $title = 'Профиль '.$user->name;
            $description = 'Профиль пользователя '.$user->name;
            return view('user', ['title' => $title, 
               'description' => $description,
               'user' => $user]);
        }
        else{
            abort(404);
        }
    }
    
    /**
    * Обновляет пользователя
    * @param User $user
    * @param Request $request
    * @param UserService $userService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(User $user, UserRequest $request, UserService $userService)
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
             return redirect(route('user.index'));
        }
    }
}
