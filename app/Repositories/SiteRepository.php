<?php

namespace Blog\Repositories;

use Blog\Models\Site;

/** 
 * Класс репозитория сайтов
 */
class SiteRepository extends BaseRepository
{
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