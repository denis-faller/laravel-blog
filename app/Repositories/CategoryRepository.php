<?php

namespace Blog\Repositories;

use Blog\Models\Category;
use Blog\Repositories\Traits\Sortable;

/** 
 * Класс репозитория категории
 */
class CategoryRepository extends BaseRepository
{
    use Sortable;
    
    /**
    * Экземпляр модели категории
    * @var Category
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param Category $category
    */ 
    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    
    /**
    * Находит элемент модели по url
    * @param string $url 
    * @return Blog\Models\Category
    */  
    public function findByUrl($url)
    {
        return $this->model->where('url', $url)->first();
    }
}