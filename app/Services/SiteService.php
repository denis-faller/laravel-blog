<?php

namespace Blog\Services;

use Blog\Repositories\SiteRepository;

/** 
 * Класс сервиса сайта
 */
class SiteService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param SiteRepository $siteRepository
    */ 
   public function __construct(SiteRepository $siteRepository)
   {
       $this->repo = $siteRepository;
   }
   
    /**
    * Возвращает все сайты
    * @return Blog\Model
    */  
    public function all()
    {
        $this->repo->setFilterBy('deleted_at');
        $this->repo->setFilterValue(NULL); 
        
        return $this->repo->all();
    }

}