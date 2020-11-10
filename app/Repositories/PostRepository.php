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
    
    /**
    * Возвращает пагинатор для постов тега
    * @param int $tagID
    * @param int $paginate
    * @return Blog\Post
    */  
    public function getPaginatePostsByTag($tagID, $paginate)
     {
        return $this->model::whereHas('tags', function ($query) use ($tagID) {
            $query->where('id', $tagID);
        })->orderBy('publish_time', 'desc')->paginate($paginate);
    }
    
    /**
    * Возвращает посты, отсортированные по популярности
    * @param int $limit
    * @return Blog\Post
    */  
    public function getPostsPopular($limit)
    {
       return $this->model->orderBy("view_count", "desc")->take($limit)->get();
    }
    
    /**
    * Инкремент счетчика просмотров текущего поста
    * @param int $viewCount
    * @return int $incrementViewCount
    */  
    public function incrementViewCount($postID, $viewCount)
    {
       $incrementViewCount = $viewCount + 1;
       $this->model
            ->where('id', $postID)
            ->update(['view_count' => $incrementViewCount]);
       return $incrementViewCount;
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
       return $this->model
               ->where([["id", '<>', $postID], ["category_id", '=', $categoryID]])
               ->orderBy("id", "desc")
               ->take($limit)
               ->get();
    }
    
        
    /**
    * Удаляет пост
    * @param int $postID
    * @return Blog\Models\Post
    */  
    public function destroy($postID)
    {
        $post = $this->find($postID);
        $post->tags()->detach();
        return $post->delete();
    }
}