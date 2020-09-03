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
    * @param int $paginate
    * @return Blog\Post
    */  
    public function getPostsForMainPage($paginate)
    {
       $this->repo->setFilterBy('main_page');
       $this->repo->setFilterValue(1);
        
        return $this->repo->getPaginatePosts($paginate)->all();
    }
    

    /**
    * Возвращает пагинатор для постов
    * @param int $paginate
    * @return Blog\Post
    */  
    public function getPaginatePosts($paginate)
    {
       $this->repo->setFilterBy();
       $this->repo->setFilterValue(); 
        
       $this->repo->setSortBy('publish_time');
       $this->repo->setSortOrder('desc');
       
       return $this->repo->getPaginatePosts($paginate);
    }
    
    /**
    * Возвращает пагинатор для постов категории
    * @param int $categoryID
    * @param int $paginate
    * @return Blog\Post
    */  
    public function getPaginatePostsByCategory($categoryID, $paginate)
    {
       $this->repo->setFilterBy('category_id');
       $this->repo->setFilterValue($categoryID); 
        
       $this->repo->setSortBy('publish_time');
       $this->repo->setSortOrder('desc');
       
       return $this->repo->getPaginatePosts($paginate);
    }
    
    /**
    * Возвращает пагинатор для постов тега
    * @param int $tagID
    * @param int $paginate
    * @return Blog\Post
    */  
    public function getPaginatePostsByTag($tagID, $paginate)
    {
       return $this->repo->getPaginatePostsByTag($tagID, $paginate);
    }
    
    /**
    * Находит пост по url
    * @param string $url
    * @return Blog\Models\Post
    */  
    public function findByUrl($url)
    {
        $this->repo->setFilterBy('url');
        $this->repo->setFilterValue($url); 
        
        return $this->repo->all()->first();
    }
    
    /**
    * Возвращает посты, отсортированные по популярности
    * @param int $limit
    * @return Blog\Post
    */  
    public function getPostsPopular($limit)
    {
       return $this->repo->getPostsPopular($limit);
    }
    
    /**
    * Инкремент счетчика просмотров текущего поста
    * @param int $viewCount
    * @return int
    */  
    public function incrementViewCount($postID, $viewCount)
    {
       return $this->repo->incrementViewCount($postID, $viewCount);
    }
    
    /**
    * Возвращает похожие посты категории
    * @param int $postID
    * @param int $categoryID
    * @param int $limit
    * @return Blog\Post
    */  
    public function getRelatedPost($postID, $categoryID, $limit)
    {
       return $this->repo->getRelatedPost($postID, $categoryID, $limit);
    }
}