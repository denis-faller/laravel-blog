<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Models\Post;

/** 
 * Контроллер для вывода страницы поиска
 */
class SearchController extends Controller
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
    * Возвращает представление страницы поиска
    * @param Request $request
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request)
    {
        if(trim($request->q) != ""){
            $query = $request->q;
            $paginatePosts = Post::search($request->q)->paginate(15);
            $posts = $paginatePosts->all();
            $currentPage = $paginatePosts->currentPage();
        }
        
        $title = "Страница поиска - страница ".$currentPage;
        $description = "Страница поиска по запросу $query - страница ".$currentPage;
        
        return view('search', ['title' => $title, 
           'description' => $description,
           'query' => $query,
           'posts' => $posts,
           'paginatePosts' => $paginatePosts]);
    } 
}
