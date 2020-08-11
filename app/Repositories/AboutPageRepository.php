<?php

namespace Blog\Repositories;

use Blog\Models\AboutPage;
use Blog\Repositories\Traits\Sortable;

/** 
 * Класс репозитория страницы о блоге
 */
class AboutPageRepository extends BaseRepository
{
    use Sortable;
    /**
    * Экземпляр модели сайта
    * @var AboutPage
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param AboutPage $page
    */ 
    public function __construct(AboutPage $page)
    {
        $this->model = $page;
    }
}