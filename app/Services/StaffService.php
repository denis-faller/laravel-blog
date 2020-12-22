<?php

namespace Blog\Services;

use Blog\Repositories\StaffRepository;
use Blog\Models\AboutPage;

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
    * @return Blog\Models\Staff
    */ 
   public function getStaff($id)
   {
       $this->repo->setFilterBy('about_page_id');
       $this->repo->setFilterValue($id);
       
       return $this->repo->all();
   }
   
    /**
    * Возвращает сотрудников постранично
    * @param int $id
    * @return Blog\Models\Staff
    */ 
   public function paginated($paginate)
   {
       $this->repo->setFilterBy('deleted_at');
       $this->repo->setFilterValue(NULL);
       
       return $this->repo->paginated($paginate);
   }
   
    /**
    * Находит сотрудника по имени
    * @param string $name
    * @return Blog\Models\Staff
    */  
    public function findByName($name)
    {
        $this->repo->setFilterBy('name');
        $this->repo->setFilterValue($name); 
        
        return $this->repo->all()->first();
    }
}