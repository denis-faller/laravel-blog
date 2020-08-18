<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Services\PostService;
use Blog\Services\CategoryService;

/** 
 * Контроллер для вывода страницы категории
 */
class CategoryController extends Controller
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
    * Возвращает представление страницы категории
    * @param string $categoryUrl
    * @param Request $request
    * @param CategoryService $categoryService
    * @param PostService $postService
    * @return Illuminate\Support\Facades\View
    */  
    public function show($categoryUrl, Request $request, CategoryService $categoryService, PostService $postService)
    {
        $category = $categoryService->findByUrl($categoryUrl);
        
        if(isset($category->id)){
            $paginatePosts = $postService->getPaginatePostsByCategory($category->id, 9);
        }
        
        if(!isset($category->id) || ($request->page < 0 || $request->page > $paginatePosts->lastPage())){
            abort(404);
        }
        
        $currentPage = $paginatePosts->currentPage();
        $title = "Последние посты категории $category->name - страница ".$currentPage;
        $description = "Последние посты категории $category->name блога - страница ".$currentPage;
        
        $posts = $paginatePosts->all();
        
        return view('posts.category', ['title' => $title, 
           'description' => $description,
           'category' => $category,
           'posts' => $posts,
           'paginatePosts' => $paginatePosts]);
    } 
}
