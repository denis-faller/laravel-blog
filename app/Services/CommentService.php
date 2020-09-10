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
    * @param int $postID
    * @return Blog\Models\Comment
    */  
    public function findByPostID($postID)
    {
        $this->repo->setFilterBy('post_id');
        $this->repo->setFilterValue($postID); 
        
        return $this->repo->all();
    }
    
    /**
    * Возвращает комментарий с определенным сообщением
    * @param string $message
    * @return Blog\Models\Comment
    */  
    public function findByMessage($message)
    {
        $this->repo->setFilterBy('message');
        $this->repo->setFilterValue($message); 
        
        return $this->repo->all()->first();
    }
}