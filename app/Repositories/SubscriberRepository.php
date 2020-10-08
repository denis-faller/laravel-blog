<?php

namespace Blog\Repositories;

use Blog\Models\Subscriber;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория подписки
 */
class SubscriberRepository extends BaseRepository
{
    use Filterable;
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