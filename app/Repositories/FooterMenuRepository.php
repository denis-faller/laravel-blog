<?php

namespace Blog\Repositories;

use Blog\Models\FooterMenu;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория меню
 */
class FooterMenuRepository extends BaseRepository
{
    use Sortable;
    use Filterable;
    /**
    * Экземпляр модели сайта
    * @var FooterMenu
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param FooterMenu $menu
    */ 
    public function __construct(FooterMenu $menu)
    {
        $this->model = $menu;
    }
}