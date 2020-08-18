<?php

namespace Blog\Services;

use Blog\Repositories\CategoryRepository;

/** 
 * Класс сервиса категории
 */
class CategoryService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param CategoryRepository $categoryRepository
    */ 
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->repo = $categoryRepository;
    }
   
    /**
    * Находит категорию по url
    * @param string $url
    * @return Blog\Models\Category
    */  
    public function findByUrl($url)
    {
        return $this->repo->findByUrl($url);
    }
}