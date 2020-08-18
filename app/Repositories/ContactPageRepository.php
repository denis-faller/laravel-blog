<?php

namespace Blog\Repositories;

use Blog\Models\ContactPage;
use Blog\Repositories\Traits\Sortable;

/** 
 * Класс репозитория страницы контактов
 */
class ContactPageRepository extends BaseRepository
{
    use Sortable;
    /**
    * Экземпляр модели сайта
    * @var ContactPage
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param AboutPage $page
    */ 
    public function __construct(ContactPage $page)
    {
        $this->model = $page;
    }
}