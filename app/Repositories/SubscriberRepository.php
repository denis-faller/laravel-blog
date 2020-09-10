<?php

namespace Blog\Repositories;

use Blog\Models\Subscriber;

/** 
 * Класс репозитория подписки
 */
class SubscriberRepository extends BaseRepository
{
    /**
    * Экземпляр модели подписки
    * @var Subscriber
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param Subscriber $subscriber
    */ 
    public function __construct(Subscriber $subscriber)
    {
        $this->model = $subscriber;
    }
}