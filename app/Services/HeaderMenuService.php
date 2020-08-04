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
       
       $this->repo->setSortBy('sort');
       $this->repo->setSortOrder('asc');
   }
}