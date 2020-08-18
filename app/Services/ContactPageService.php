<?php

namespace Blog\Services;

use Blog\Repositories\ContactPageRepository;

/** 
 * Класс сервиса страницы контактов
 */
class ContactPageService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param ContactPageRepository $contactPageRepository
    */ 
   public function __construct(ContactPageRepository $contactPageRepository)
   {
       $this->repo = $contactPageRepository;
   }
}