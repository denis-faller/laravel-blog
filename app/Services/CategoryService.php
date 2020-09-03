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
        $this->repo->setFilterBy('url');
        $this->repo->setFilterValue($url); 
        
        return $this->repo->all()->first();
    }
    
        
    /**
    * Возвращает кол-во постов для каждой категории
    * @return Blog\Models\Category
    */  
    public function getСountPostsByCategory()
    {
       return $this->repo->getСountPostsByCategory();
    }
}