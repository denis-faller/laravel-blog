<?php

namespace Blog\Services;

use Blog\Repositories\PostRepository;

/** 
 * Класс сервиса поста
 */
class PostService extends BaseService
{    
    /**
    * Конструктор сервиса
    * @param PostRepository $postRepository
    */ 
   public function __construct(PostRepository $postRepository)
   {
       $this->repo = $postRepository;
   }
   
    /**
    * Возвращает посты, которые должны быть выведены на главной
    * @return Blog\Post
    */  
    public function getPostsForMainPage()
    {
        return $this->repo->getPostsForMainPage();
    }
    
    /**
    * Возвращает посты, отсортированные по дате
    * @return Blog\Post
    */  
    public function getRecentPosts()
    {
       $this->repo->setSortBy('publish_time');
       $this->repo->setSortOrder('desc');
       
       return $this->repo;
    }
}