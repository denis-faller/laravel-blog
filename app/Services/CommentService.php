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
    * Возвращает комментарии с определленым родительским комментарием
    * @param int $parentID
    * @return Blog\Models\Comment
    */  
    public function findByParentID($parentID)
    {
        $this->repo->setFilterBy('parent_id');
        $this->repo->setFilterValue($parentID); 
        
        return $this->repo->all();
    }
    
    /**
    * Возвращает комментарии страницы
    * @param int $paginate
    * @return Blog\Models\Comment
    */  
    public function getPaginatedComment($paginate)
    {
        $this->repo->setFilterBy('deleted_at');
        $this->repo->setFilterValue(NULL); 
        
        return $this->repo->paginated($paginate);
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
    
    /**
    * Возвращает комментарии поста, исключая определенный комментарий
    * @param int $postID
    * @param int $commentID
    * @return Blog\Models\Comment
    */  
    public function getCommentsByPostIdAndCondition($postID, $commentID)
    {
        return $this->repo->getCommentsByPostIdAndCondition($postID, $commentID);
    }
}