<?php

namespace Blog\Repositories;

use Blog\Models\Post;
use Blog\Repositories\Traits\Sortable;

/** 
 * Класс репозитория поста
 */
class PostRepository extends BaseRepository
{
    use Sortable;
    /**
    * Экземпляр модели поста
    * @var Post
    */ 
    protected $model;

    /**
    * Конструктор репозитория
    * @param Post $post
    */ 
    public function __construct(Post $post)
    {
        $this->model = $post;
    }
    
    /**
    * Возвращает посты, которые должны быть выведены на главной
    * @return Blog\Post
    */  
    public function getPostsForMainPage()
    {
        return $this->model->where('main_page', 1)->take(9)->get();
    }
}