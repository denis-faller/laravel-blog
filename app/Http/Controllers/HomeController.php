<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Services\PostService;

/** 
 * Контроллер для вывода контента главной страницы
 */
class HomeController extends Controller
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
    * Возвращает представление главной страницы
    * @param StaticPageService $service
    * @return Illuminate\Support\Facades\View
    */  
    public function index(PostService $postService)
    {
        $postsForMainPage = $postService->getPostsForMainPage();
        
        $postsForMainPage = array_chunk($postsForMainPage->all(), ceil(count($postsForMainPage)/2));
        $recentPosts = $postService->getRecentPosts();
        
        return view('home', ['title' => 'Главная', 
            'description' => 'Главная страница сайта', 
            'postsForMainPage' => $postsForMainPage]);
    }
}
