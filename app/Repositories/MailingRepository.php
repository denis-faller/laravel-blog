<?php

namespace Blog\Repositories;

use Blog\Models\Mailing;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория рассылки
 */
class MailingRepository extends BaseRepository
{
    use Filterable;
    /**
    * Экземпляр модели подписки
    * @var Mailing
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param Mailing $mailing
    */ 
    public function __construct(Mailing $mailing)
    {
        $this->model = $mailing;
    }
    
    /**
    * Возвращает рассылки постранично
    * @param int $paginate
    * @return Blog\Model
    */  
    public function paginated($paginate)
    {
        return $this->model::with("post")
            ->where($this->filterBy, $this->filterValue)       
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($paginate);
    }
}