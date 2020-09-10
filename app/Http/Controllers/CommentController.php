<?php

namespace Blog\Http\Controllers;

use Blog\Http\Requests\CommentAddRequest;
use Blog\Services\CommentService;
use Blog\Services\PostService;

/** 
 * Контроллер для комментария
 */
class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    
    /**
    * Выводит вложенные комментарии
    * @param int $id
    * @param array $comments
    */  
    public static function nestedComment($id, $comments){
       $commentsNested = array_filter($comments, function($k) use($id){
           foreach($k as $value){
               if($value->parent_id == $id){
                  return  true;
               }
           }        
       });
       
       foreach($commentsNested as $commentAr){
           $index = 0;
           foreach($commentAr as $comment){
                if($index == 0){
                    echo '<ul class="children">';
                }
                echo '<li class="comment">
                    <div class="vcard">';
                    if(isset($comment->author)){
                        echo '<img src="'.$comment->author->img.'" alt="'.$comment->author->name.'">';
                    }
                    echo '  
                    </div>
                    <div class="comment-body">';
                    if(isset($comment->author)){
                        echo '<h3>'.$comment->author->name.'</h3>';
                    }
                    else{
                       echo '<h3>'.$comment->name.'</h3>';
                    }
                    echo '
                      <div class="meta">'.date('M d, Y at H:i', strtotime($comment->created_at)).'</div>
                      <p>'.$comment->message.'</p>
                      <p><a data-id = "'.$comment->id.'" href="#add-comment" class="reply rounded">Reply</a></p>
                    </div>
                </li>';
               self::nestedComment($comment->id, $comments);
               if($index == (count($commentAr)-1)){
                    echo '</ul>';
               }
               $index++;
           }
       }
    }

    /**
    * Создает новый комментарий
    * @param CommentService $commentService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(CommentAddRequest $request, CommentService $commentService, PostService $postService)
    {
        $commentService->create(array('post_id' => $request->post_id, 
            'parent_id' => $request->parent_id, 
            'name' => $request->name, 
            'email' => $request->email, 
            'website' => $request->website, 
            'message' => $request->message));
        $post = $postService->find($request->post_id);
        
        if(isset($post->url)){
            return redirect(route('post.show', $post->url));
        }
        else{
            abort(404);
        }
    } 
}
