<?php

namespace Blog\Repositories\Traits;

/** 
 * Примесь для сортировки
 */
trait Sortable
{
    /**
    * Свойство, хранящее поле для сортировки
    * @var string
    */
    protected $sortBy = 'created_at';
   
    /**
    * Свойство, хранящее порядок сортировки
    * @var string
    */
    protected $sortOrder = 'asc';

    /**
    * Устанавливает поле сортировки
    * @param string $sortBy
    */  
    public function setSortBy($sortBy = 'created_at')
    {
        $this->sortBy = $sortBy;
    }
    
    /**
    * Устанавливает порядок сортировки
    * @param string $sortOrder
    */
    public function setSortOrder($sortOrder = 'asc')
    {
        $this->sortOrder = $sortOrder;
    }
}