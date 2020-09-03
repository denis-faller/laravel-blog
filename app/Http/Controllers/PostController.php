<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Services\PostService;
use Blog\Services\CategoryService;
use Blog\Services\TagService;
use Blog\Services\CommentService;

/** 
 * Контроллер для вывода страницы поста
 */
class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    
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
                      <p><a href="#" class="reply rounded">Reply</a></p>
                    </div>
                </li>';
               if($index == (count($commentAr)-1)){
                    echo '</ul>';
               }
               $index++;
               self::nestedComment($comment->id, $comments);
           }
       }
    }

    /**
    * Возвращает представление страницы поста
    * @param string $urlPost
    * @param PostService $postService
    * @param CategoryService $categoryService
    * @param TagService $tagService 
    * @return Illuminate\Support\Facades\View
    */  
    public function show($postUrl, PostService $postService, CategoryService $categoryService, TagService $tagService, CommentService $commentService)
    {
        $post = $postService->findByUrl($postUrl);
        
        $popularPosts = $postService->getPostsPopular(3);
        
        $categories = $categoryService->getСountPostsByCategory();
        
        $tags = $tagService->all();
        
        $comments = $commentService->findByPostID($post->id);
        $countComments = count($comments);
        
        $commentsAr = array();
        
        foreach($comments as $comment){
            if($comment->parent_id == NULL){
                $commentsAr[0][] = $comment;
            }
            else{
                $commentsAr[$comment->parent_id][] = $comment;
            }
        }
        
        if(!isset($post->id)){
            abort(404);
        }
        
        $relatedPosts = $postService->getRelatedPost($post->id, $post->category_id, 4);
        
        $postService->incrementViewCount($post->id, $post->view_count);
        
        
        $title = "Пост $post->name";
        $description = "Пост $post->name блога";
        
        return view('posts.index', ['title' => $title, 
           'description' => $description,
           'post' => $post,
           'popularPosts' => $popularPosts,
           'categories' => $categories,
           'tags' => $tags,
           'relatedPosts' => $relatedPosts,
           'countComments' => $countComments,
           'commentsAr' => $commentsAr]);
    }
}
