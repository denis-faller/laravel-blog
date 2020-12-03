<?php

namespace Blog\Services;

use Blog\Repositories\HeaderMenuRepository;

/** 
 * Класс сервиса меню
 */
class HeaderMenuService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param HeaderMenuRepository $menuRepository
    */ 
   public function __construct(HeaderMenuRepository $menuRepository)
   {
        $this->repo = $menuRepository;
   }

    /**
    * Возвращает пункты меню, отсортированные по значению сортировки
    * @return Blog\Models\HeaderMenu
    */  
    public function getSortedMenu()
    {
        $this->repo->setSortBy('sort');
        $this->repo->setSortOrder('asc');

        return $this->repo->all();
    }
   
    /**
    * Возвращает пункты меню постранично
    * @return Blog\Models\HeaderMenu
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
    * @return Blog\Models\HeaderMenu
    */  
    public function findByUrl($url)
    {
        $this->repo->setFilterBy('url');
        $this->repo->setFilterValue($url); 
        
        return $this->repo->all()->first();
    }
}