<?php

namespace Blog\Services;

use Blog\Repositories\CommentRepository;

/** 
 * Класс сервиса комментария
 */
class CommentService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param CommentRepository $commentRepository
    */ 
    public function __construct(CommentRepository $commentRepository)
    {
        $this->repo = $commentRepository;
    }
    
    /**
    * Возвращает комментарии поста
    * @param string $url
    * @return Blog\Models\Tag
    */  
    public function findByPostID($postID)
    {
        $this->repo->setFilterBy('post_id');
        $this->repo->setFilterValue($postID); 
        
        return $this->repo->all();
    }
}