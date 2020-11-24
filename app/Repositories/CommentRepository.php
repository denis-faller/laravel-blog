<?php

namespace Blog\Repositories;

use Blog\Models\Comment;
use Blog\Repositories\Traits\Sortable;
use Blog\Repositories\Traits\Filterable;
use Blog\Services\CommentService;

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
    
   /**
    * Возвращает комментарии поста, исключая комментарий с определенным id
    * @param int $postID
    * @param int $commentID
    * @return Blog\Comment
    */  
    public function getCommentsByPostIdAndCondition($postID, $commentID)
    {
       return $this->model
               ->where([["post_id", '=', $postID], ["id", '<>', $commentID]])
               ->orderBy("id", "asc")
               ->get();
    }
    
    
    public static function deleteNestedComment($id, $comments){
        $commentsNested = array_filter($comments, function($k) use($id){
           foreach($k as $value){
               if($value->parent_id == $id){
                  return  true;
               }
           }        
       });
       
       foreach($commentsNested as $commentAr){
           foreach($commentAr as $comment){
               self::deleteNestedComment($comment->id, $comments);
               $comment->delete();
           }
       }
    }
    
    
    /**
    * Удаляет комментарий
    * @param int $commentID
    * @return Blog\Models\Comment
    */  
    public function destroy($commentID)
    {
        $commentService = app(CommentService::class);
        
        $commentOnDeleting = $commentService->find($commentID);
        
        $comments = $commentService->findByParentID($commentID);
        
        $commentsAr = array();
        
        foreach($comments as $comment){
            if($comment->parent_id == NULL){
                $commentsAr[0][] = $comment;
            }
            else{
                $commentsAr[$comment->parent_id][] = $comment;
            }
        }
  
        self::deleteNestedComment($commentOnDeleting->id, $commentsAr);
        
        return $commentOnDeleting->delete();
    }
}