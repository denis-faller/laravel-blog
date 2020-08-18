<?php

namespace Blog\Repositories;

use Blog\Models\Tag;
use Blog\Repositories\Traits\Sortable;

/** 
 * Класс репозитория тега
 */
class TagRepository extends BaseRepository
{
    use Sortable;
    
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

    
    /**
    * Находит элемент модели по url
    * @param string $url 
    * @return Blog\Models\Tag
    */  
    public function findByUrl($url)
    {
        return $this->model->where('url', $url)->first();
    }
}