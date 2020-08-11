<?php

namespace Blog\Services;

use Blog\Repositories\StaffRepository;

/** 
 * Класс сервиса штата сотрудников
 */
class StaffService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param StaffRepository $staffRepository
    */ 
   public function __construct(StaffRepository $staffRepository)
   {
       $this->repo = $staffRepository;
   }
   
    /**
    * Возвращает сотрудников компании для конкретной страницы
    * @param int $id
    * @return Blog\Staff
    */ 
   public function getStaff($id)
   {
       $this->repo->setFilterBy('about_page_id');
       $this->repo->setFilterValue($id);
       
       return $this->repo->all();
   }
}