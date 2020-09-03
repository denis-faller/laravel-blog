<?php

namespace Blog\Repositories;

use Blog\Models\Category;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;
use Illuminate\Support\Facades\DB;

/** 
 * Класс репозитория категории
 */
class CategoryRepository extends BaseRepository
{
    use Sortable;
    use Filterable;
    
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
    * Возвращает кол-во постов для каждой категории
    * @return Blog\Models\Category
    */  
    public function getСountPostsByCategory()
    {
       return $this->model
               ->select('categories.id', DB::raw('count(*) as total'), 'categories.name', 'categories.url')
               ->join('posts', 'categories.id', '=', 'posts.category_id')
               ->groupBy('posts.category_id')
               ->get();
    }
}