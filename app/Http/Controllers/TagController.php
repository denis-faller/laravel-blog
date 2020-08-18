<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Services\PostService;
use Blog\Services\TagService;

/** 
 * Контроллер для вывода страницы постов тега
 */
class TagController extends Controller
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
    * Возвращает представление страницы тега
    * @param string $tagUrl
    * @param Request $request
    * @param TagService $tagService
    * @param PostService $postService
    * @return Illuminate\Support\Facades\View
    */  
    public function show($tagUrl, Request $request, TagService $tagService, PostService $postService)
    {
        $tag = $tagService->findByUrl($tagUrl);
        
        if(isset($tag->id)){
            $paginatePosts = $postService->getPaginatePostsByTag($tag->id, 9);
        }
        
        if(!isset($tag->id) || ($request->page < 0 || $request->page > $paginatePosts->lastPage())){
            abort(404);
        }
        
        $currentPage = $paginatePosts->currentPage();
        $title = "Последние посты тега $tag->name - страница ".$currentPage;
        $description = "Последние посты тега $tag->name блога - страница ".$currentPage;
        
        $posts = $paginatePosts->all();
        
        return view('posts.tag', ['title' => $title, 
           'description' => $description,
           'tag' => $tag,
           'posts' => $posts,
           'paginatePosts' => $paginatePosts]);
    } 
}
