<?php

namespace Blog\Repositories;

use Blog\Models\Role;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория роли
 */
class RoleRepository extends BaseRepository
{
    
    /**
    * Экземпляр модели роли
    * @var User
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param Role $role
    */ 
    public function __construct(Role $role)
    {
        $this->model = $role;
    }
}