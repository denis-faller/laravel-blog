<?php

namespace Blog\Services;

use Blog\Repositories\AboutPageRepository;

/** 
 * Класс сервиса страницы о блоге
 */
class AboutPageService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param AboutPageRepository $aboutPageRepository
    */ 
   public function __construct(AboutPageRepository $aboutPageRepository)
   {
       $this->repo = $aboutPageRepository;
   }
}