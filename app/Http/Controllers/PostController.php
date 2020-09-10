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
