<?php

namespace Blog\Repositories\Traits;

/** 
 * Примесь для фильтрации
 */
trait Filterable
{
    /**
    * Свойство, хранящее поле для фильтрации
    * @var string
    */
    protected $filterBy = 'site_id';
    
    /**
    * Свойство, хранящее значения для фильтрации
    * @var mixed
    */
    protected $filterValue = 1;

    /**
    * Устанавливает поле для фильтрации
    * @param string $filterBy
    */  
    public function setFilterBy($filterBy = 'site_id')
    {
        $this->filterBy = $filterBy;
    }
    
    /**
    * Устанавливает значения для фильтрации
    * @param mixed $filterValue
    */
    public function setFilterValue($filterValue = 1)
    {
        $this->filterValue = $filterValue;
    }
}