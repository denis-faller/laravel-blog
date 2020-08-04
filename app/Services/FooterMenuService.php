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
       
       $this->repo->setSortBy('sort');
       $this->repo->setSortOrder('asc');
   }
}