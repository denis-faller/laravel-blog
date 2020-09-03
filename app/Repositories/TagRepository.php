<?php

namespace Blog\Repositories;

use Blog\Models\Tag;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория тега
 */
class TagRepository extends BaseRepository
{
    use Sortable;
    use Filterable;
    
    /**
    * Экземпляр модели тега
    * @var Tag
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param Tag $tag
    */ 
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }
}