<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\CategoryService;
use Blog\Http\Controllers\Controller;
use Blog\Models\Category;
use Blog\Models\Site;
use Blog\Http\Requests\CategoryRequest;

/** 
 * Контроллер для работы с категориями из админки
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
    * Возвращает представление страницы категорий
    * @param Request $request
    * @param CategoryService $categoryService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, CategoryService $categoryService)
    {
        $this->authorize('index', Category::class);
        
        $paginateCategories = $categoryService->paginated(9);
        
        if($request->page < 0 || $request->page > $paginateCategories->lastPage()){
            abort(404);
        }
        $currentPage = $paginateCategories->currentPage();
        
        $categories = $paginateCategories->all();
        $title = 'Категории блога - страница '.$currentPage;
        $description = 'Все категории блога - страница '.$currentPage;
        
        return view('admin.categories.index', ['title' => $title, 
            'description' => $description,
            'categories' => $categories,
            'paginateCategories' => $paginateCategories]);
    }
    
    /**
    * Возвращает представление страницы создания категории
    * @param CategoryService $categoryService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(CategoryService $categoryService)
    {
        $this->authorize('create', Category::class);

        $title = 'Создание новой категории';
        $description = 'Создание новой категории';
        return view('admin.categories.create', ['title' => $title, 
           'description' => $description]);
    }
    
    /**
    * Создает категорию
    * @param CategoryRequest $request
    * @param CategoryService $categoryService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(CategoryRequest $request, CategoryService $categoryService)
    {
        $this->authorize('store', Category::class);
        
        $categoryCreated = $categoryService->create(array('site_id' => Site::MAIN_SITE_ID, 'name' => $request->name, 'url' => $request->url, 'description' => $request->description));
     
        if(isset($categoryCreated->id)){
            return redirect(route('admin.category.show', $categoryCreated->id));
        }
    }
    
    /**
    * Возвращает представление страницы категории
    * @param Category $category
    * @return Illuminate\Support\Facades\View
    */  
    public function show(Category $category)
    {
        $this->authorize('show', Category::class);
        
        $title = 'Страница категории '.$category->name;
        $description = 'Страница категории '.$category->name;
        return view('admin.categories.show', ['title' => $title, 
           'description' => $description,
            'category' => $category]);
    }
    
     /**
    * Обновляет информацию о категории
    * @param Category $category
    * @param CategoryRequest $request
    * @param CategoryService $categoryService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(Category $category, CategoryRequest $request, CategoryService $categoryService)
    {
        $this->authorize('update', Category::class);
        
        $categoryUpdated = $categoryService->update($category->id, array('name' => $request->name, 'url' => $request->url, 'description' => $request->description));
        
        if(isset($categoryUpdated->id)){
            return redirect(route('admin.category.show', $category->id));
        }
    }
    
    /**
    * Удаляет категорию
    * @param Category $category
    * @param CategoryService $categoryService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(Category $category, CategoryService $categoryService)
    {
        $this->authorize('destroy', Category::class);
        
        $isDelete = $categoryService->destroy($category->id);
        
        if($isDelete){
            return redirect(route('admin.category.index'));
        }
    }
}
