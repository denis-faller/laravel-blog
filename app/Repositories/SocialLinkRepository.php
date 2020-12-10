<?php

namespace Blog\Repositories;

use Blog\Models\SocialLink;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория социальных ссылок
 */
class SocialLinkRepository extends BaseRepository
{
    use Sortable;
    use Filterable;
    /**
    * Экземпляр модели сайта
    * @var SocialLinks
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param SocialLinks $links
    */ 
    public function __construct(SocialLink $links)
    {
        $this->model = $links;
    }
}