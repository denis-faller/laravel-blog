<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Services\PostService;

/** 
 * Контроллер для вывода страницы последних постов
 */
class RecentPostsController extends Controller
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
    * Возвращает представление страницы последних постов
    * @param Request $request
    * @param PostService $postService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, PostService $postService)
    {
        $paginatePosts = $postService->getPaginatePosts(9);
        
        if($request->page < 0 || $request->page > $paginatePosts->lastPage()){
            abort(404);
        }
        
        $currentPage = $paginatePosts->currentPage();
        $title = 'Последние посты - страница '.$currentPage;
        $description = 'Последние посты блога - страница '.$currentPage;
        
        $posts = $paginatePosts->all();
        
        return view('posts.recent', ['title' => $title, 
           'description' => $description,
           'posts' => $posts,
           'paginatePosts' => $paginatePosts]);
    }
        
}
