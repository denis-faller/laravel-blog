<?php

namespace Blog\Repositories;

use Blog\Models\User;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;
use Blog\Models\Role;

/** 
 * Класс репозитория юзера
 */
class UserRepository extends BaseRepository
{
    use Filterable;
    /**
    * Экземпляр модели юзера
    * @var User
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param User $user
    */ 
    public function __construct(User $user)
    {
        $this->model = $user;
    }
    
    /**
    * Удаляет пользователя
    * @param int $userID
    * @return Blog\Models\User
    */  
    public function destroy($userID)
    {
        $user = $this->find($userID);
        $user->roles()->detach([Role::ROLE_ADMIN, Role::ROLE_REGISTERED_USER, Role::ROLE_CONTENT_MANAGER]);
        return $user->delete();
    }
}