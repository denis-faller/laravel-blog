<?php

namespace Blog\Services;

use Blog\Repositories\FooterMenuRepository;

/** 
 * Класс сервиса меню
 */
class FooterMenuService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param FooterMenuRepository $menuRepository
    */ 
    public function __construct(FooterMenuRepository $menuRepository)
    {
        $this->repo = $menuRepository;
    }

    /**
    * Возвращает пункты меню, отсортированные по значению сортировки
    * @return Blog\Models\FooterMenu
    */  
    public function getSortedMenu()
    {
        $this->repo->setSortBy('sort');
        $this->repo->setSortOrder('asc');

        return $this->repo->all();
    }
   
    /**
    * Возвращает пункты меню постранично
    * @return Blog\Models\FooterMenu
    */  
    public function paginated($paginate)
    {
        $this->repo->setSortBy('id');
        $this->repo->setSortOrder('asc');
        
        return $this->repo->paginated($paginate);
    }
    
       
    /**
    * Находит пункт верхнего меню по url
    * @param string $url
    * @return Blog\Models\FooterMenu
    */  
    public function findByUrl($url)
    {
        $this->repo->setFilterBy('url');
        $this->repo->setFilterValue($url); 
        
        return $this->repo->all()->first();
    }
}