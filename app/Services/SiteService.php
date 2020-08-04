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
}