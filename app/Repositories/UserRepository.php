<?php

namespace Blog\Repositories;

use Blog\Models\User;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория юзера
 */
class UserRepository extends BaseRepository
{
    
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
}