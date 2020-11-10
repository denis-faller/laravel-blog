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
    
   /**
    * Возвращает пользователя с определенным email
    * @param string $email
    * @return Blog\Models\User
    */  
    public function findByEmail($email)
    {
        $this->repo->setFilterBy('email');
        $this->repo->setFilterValue($email); 
        
        return $this->repo->all()->first();
    }
}