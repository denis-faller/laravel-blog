<?php

namespace Blog\Services;

use Blog\Repositories\RoleRepository;

/** 
 * Класс сервиса роли
 */
class RoleService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param RoleRepository $roleRepository
    */ 
    public function __construct(RoleRepository $roleRepository)
    {
        $this->repo = $roleRepository;
    }
}