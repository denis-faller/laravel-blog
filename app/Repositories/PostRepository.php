<?php

namespace Blog\Repositories;

use Blog\Models\Post;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;

/** 
 * Класс репозитория поста
 */
class PostRepository extends BaseRepository
{
    use Sortable;
    use Filterable;
    
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
    * Возвращает пагинатор для постов
    * @param int $paginate
    * @return Blog\Post
    */  
    public function getPaginatePosts($paginate)
    {
        return $this->paginated($paginate);
    } 
}