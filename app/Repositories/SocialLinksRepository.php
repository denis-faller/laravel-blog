<?php

namespace Blog\Repositories;

use Blog\Models\SocialLinks;
use Blog\Repositories\Traits\Sortable;

/** 
 * Класс репозитория социальных ссылок
 */
class SocialLinksRepository extends BaseRepository
{
    use Sortable;
    /**
    * Экземпляр модели сайта
    * @var SocialLinks
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param SocialLinks $links
    */ 
    public function __construct(SocialLinks $links)
    {
        $this->model = $links;
    }
}