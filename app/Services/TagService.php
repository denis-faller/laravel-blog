<?php

namespace Blog\Services;

use Blog\Repositories\TagRepository;

/** 
 * Класс сервиса тега
 */
class TagService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param TagRepository $tagRepository
    */ 
    public function __construct(TagRepository $tagRepository)
    {
        $this->repo = $tagRepository;
    }
   
    /**
    * Находит тег по url
    * @param string $url
    * @return Blog\Models\Tag
    */  
    public function findByUrl($url)
    {
        $this->repo->setFilterBy('url');
        $this->repo->setFilterValue($url); 
        
        return $this->repo->all()->first();
    }
}