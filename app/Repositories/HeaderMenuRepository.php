<?php

namespace Blog\Repositories;

use Blog\Models\HeaderMenu;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория меню
 */
class HeaderMenuRepository extends BaseRepository
{
    use Sortable;
    use Filterable;
    /**
    * Экземпляр модели сайта
    * @var HeaderMenu
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param HeaderMenu $menu
    */ 
    public function __construct(HeaderMenu $menu)
    {
        $this->model = $menu;
    }
}