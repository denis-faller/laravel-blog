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
}