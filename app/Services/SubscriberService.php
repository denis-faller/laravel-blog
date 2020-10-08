<?php

namespace Blog\Services;

use Blog\Repositories\SubscriberRepository;

/** 
 * Класс сервиса подписки
 */
class SubscriberService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param SubscriberRepository $subscriberRepository
    */ 
    public function __construct(SubscriberRepository $subscriberRepository)
    {
        $this->repo = $subscriberRepository;
    }
    
    /**
    * Возвращает подписчика с определенным email
    * @param string $email
    * @return Blog\Models\Subscriber
    */  
    public function findByEmail($email)
    {
        $this->repo->setFilterBy('email');
        $this->repo->setFilterValue($email); 
        
        return $this->repo->all()->first();
    }
}