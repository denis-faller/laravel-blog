<?php

namespace Blog\Repositories;

use Blog\Models\Staff;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория штата сотрудников
 */
class StaffRepository extends BaseRepository
{
    use Sortable;
    use Filterable;
    /**
    * Экземпляр модели сайта
    * @var Staff
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param Staff $staff
    */ 
    public function __construct(Staff $staff)
    {
        $this->model = $staff;
    }
}