<?php

namespace Blog\Services;

use Blog\Repositories\UserRepository;

/** 
 * Класс сервиса юзера
 */
class UserService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param UserRepository $userRepository
    */ 
    public function __construct(UserRepository $userRepository)
    {
        $this->repo = $userRepository;
    }
}