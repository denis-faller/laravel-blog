<?php

namespace Blog\Repositories;

use Blog\Models\Comment;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория комментария
 */
class CommentRepository extends BaseRepository
{
    use Sortable;
    use Filterable;
    
    /**
    * Экземпляр модели комментария
    * @var Comment
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param Comment $comment
    */ 
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }
}