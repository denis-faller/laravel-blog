<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\HeaderMenuService;
use Blog\Http\Controllers\Controller;
use Blog\Models\HeaderMenu;
use Blog\Models\Site;
use Blog\Http\Requests\HeaderMenuRequest;

/** 
 * Контроллер для работы с верхним меню
 */
class HeaderMenuController extends Controller
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
    * Возвращает представление страницы верхнего меню
    * @param Request $request
    * @param HeaderMenuService $headerMenuService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, HeaderMenuService $headerMenuService)
    {
        $this->authorize('index', HeaderMenu::class);
        
        $paginateHeaderMenu = $headerMenuService->paginated(9);
        
        if($request->page < 0 || $request->page > $paginateHeaderMenu->lastPage()){
            abort(404);
        }
        $currentPage = $paginateHeaderMenu->currentPage();
        
        $itemsMenu = $paginateHeaderMenu->all();
        $title = 'Верхнее меню блога - страница '.$currentPage;
        $description = 'Верхнее меню блога - страница '.$currentPage;
        
        return view('admin.header.menu.index', ['title' => $title, 
           'description' => $description,
           'itemsMenu' => $itemsMenu,
           'paginateHeaderMenu' => $paginateHeaderMenu]);
    }
    
    /**
    * Возвращает представление страницы создания пункта меню
    * @param TagService $tagService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(HeaderMenuService $headerMenuService)
    {
        $this->authorize('create', HeaderMenu::class);

        $title = 'Создание нового пункта меню';
        $description = 'Создание нового пункта меню';
        return view('admin.header.menu.create', [
           'title' => $title, 
           'description' => $description]);
    }
    
    /**
    * Создает пункт меню
    * @param HeaderMenuRequest $request
    * @param HeaderMenuService $headerMenuService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(HeaderMenuRequest $request, HeaderMenuService $headerMenuService)
    {
        $this->authorize('store', HeaderMenu::class);
        
        $itemMenuCreated = $headerMenuService->create(array(
            'site_id' => Site::MAIN_SITE_ID, 
            'name' => $request->name, 
            'url' => $request->url, 
            'sort' => $request->sort));
     
        if(isset($itemMenuCreated->id)){
            return redirect(route('admin.header.menu.show', $itemMenuCreated->id));
        }
    }
    
    /**
    * Возвращает представление страницы пункта меню
    * @param HeaderMenu $itemMenu
    * @return Illuminate\Support\Facades\View
    */
    public function show(HeaderMenu $headerMenu)
    {
        $this->authorize('show', HeaderMenu::class);
        
        $title = 'Страница пункта меню '.$headerMenu->name;
        $description = 'Страница пункта меню '.$headerMenu->name;
        return view('admin.header.menu.show', ['title' => $title, 
           'description' => $description,
           'itemMenu' => $headerMenu]);
    }
    
     /**
    * Обновляет информацию о пункте меню
    * @param HeaderMenu $headerMenu
    * @param HeaderMenuRequest $request
    * @param HeaderMenuService $headerMenuService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(HeaderMenu $headerMenu, HeaderMenuRequest $request, HeaderMenuService $headerMenuService)
    {
        $this->authorize('update', HeaderMenu::class);
        
        $headerMenuUpdated = $headerMenuService->update($headerMenu->id, array(
            'site_id' => Site::MAIN_SITE_ID, 
            'name' => $request->name, 
            'url' => $request->url, 
            'sort' => $request->sort));
        
        if(isset($headerMenuUpdated->id)){
            return redirect(route('admin.header.menu.show', $headerMenu->id));
        }
    }
    
    /**
    * Удаляет пункт меню
    * @param HeaderMenu $headerMenu
    * @param HeaderMenuService $headerMenuService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(HeaderMenu $headerMenu, HeaderMenuService $headerMenuService)
    {
        $this->authorize('destroy', HeaderMenu::class);
        
        $isDelete = $headerMenuService->destroy($headerMenu->id);
        
        if($isDelete){
            return redirect(route('admin.header.menu.index'));
        }
    }
}
