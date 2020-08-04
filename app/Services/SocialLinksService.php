<?php

namespace Blog\Services;

use Blog\Repositories\SocialLinksRepository;

/** 
 * Класс сервиса социальных ссылок
 */
class SocialLinksService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param SocialLinksRepository $linksRepository
    */ 
   public function __construct(SocialLinksRepository $linksRepository)
   {
       $this->repo = $linksRepository;
       
       $this->repo->setSortBy('sort');
       $this->repo->setSortOrder('asc');
   }
}