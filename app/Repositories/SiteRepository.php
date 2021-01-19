<?php

namespace Blog\Repositories;

use Blog\Models\Site;
use Blog\Repositories\Traits\Filterable;
/** 
 * Класс репозитория сайтов
 */
class SiteRepository extends BaseRepository
{
    use Filterable;
    /**
    * Экземпляр модели сайта
    * @var Site
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param Site $site
    */ 
    public function __construct(Site $site)
    {
        $this->model = $site;
    }
}