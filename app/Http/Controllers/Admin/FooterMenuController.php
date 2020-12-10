<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\FooterMenuService;
use Blog\Http\Controllers\Controller;
use Blog\Models\FooterMenu;
use Blog\Models\Site;
use Blog\Http\Requests\FooterMenuRequest;

/** 
 * Контроллер для работы с нижним меню
 */
class FooterMenuController extends Controller
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
    * Возвращает представление страницы нижнего меню
    * @param Request $request
    * @param FooterMenuService $footerMenuService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, FooterMenuService $footerMenuService)
    {
        $this->authorize('index', FooterMenu::class);
        
        $paginateFooterMenu = $footerMenuService->paginated(9);
        
        if($request->page < 0 || $request->page > $paginateFooterMenu->lastPage()){
            abort(404);
        }
        $currentPage = $paginateFooterMenu->currentPage();
        
        $itemsMenu = $paginateFooterMenu->all();
        
        $title = 'Нижнее меню блога - страница '.$currentPage;
        $description = 'Нижнее меню блога - страница '.$currentPage;
        
        return view('admin.footer.menu.index', ['title' => $title, 
           'description' => $description,
           'itemsMenu' => $itemsMenu,
           'paginateFooterMenu' => $paginateFooterMenu]);
    }
    
    /**
    * Возвращает представление страницы создания пункта нижнего меню
    * @param FooterMenuService $footerMenuService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(FooterMenuService $footerMenuService)
    {
        $this->authorize('create', FooterMenu::class);

        $title = 'Создание нового пункта нижнего меню';
        $description = 'Создание нового пункта нижнего меню';
        return view('admin.footer.menu.create', [
           'title' => $title, 
           'description' => $description]);
    }
    
    /**
    * Создает пункт нижнего меню
    * @param HeaderMenuRequest $request
    * @param HeaderMenuService $headerMenuService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(FooterMenuRequest $request, FooterMenuService $footerMenuService)
    {
        $this->authorize('store', FooterMenu::class);
        
        $itemMenuCreated = $footerMenuService->create(array(
            'site_id' => Site::MAIN_SITE_ID, 
            'name' => $request->name, 
            'url' => $request->url, 
            'sort' => $request->sort));
     
        if(isset($itemMenuCreated->id)){
            return redirect(route('admin.footer.menu.show', $itemMenuCreated->id));
        }
    }
    
    /**
    * Возвращает представление страницы пункта нижнего меню
    * @param FooterMenu $footerMenu
    * @return Illuminate\Support\Facades\View
    */
    public function show(FooterMenu $footerMenu)
    {
        $this->authorize('show', FooterMenu::class);
        
        $title = 'Страница пункта нижнего меню '.$footerMenu->name;
        $description = 'Страница пункта нижнего меню '.$footerMenu->name;
        
        return view('admin.footer.menu.show', ['title' => $title, 
           'description' => $description,
           'itemMenu' => $footerMenu]);
    }
    
    /**
    * Обновляет информацию о пункте нижнего меню
    * @param FooterMenu $footerMenu
    * @param FooterMenuRequest $request
    * @param FooterMenuService $footerMenuService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(FooterMenu $footerMenu, FooterMenuRequest $request, FooterMenuService $footerMenuService)
    {
        $this->authorize('update', FooterMenu::class);
        
        $itemMenuUpdated = $footerMenuService->update($footerMenu->id, array(
            'site_id' => Site::MAIN_SITE_ID, 
            'name' => $request->name, 
            'url' => $request->url, 
            'sort' => $request->sort));
        
        if(isset($itemMenuUpdated->id)){
            return redirect(route('admin.footer.menu.show', $footerMenu->id));
        }
    }
    
        
    /**
    * Удаляет пункт меню
    * @param FooterMenu $footerMenu
    * @param FooterMenuService $footerMenuService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(FooterMenu $footerMenu, FooterMenuService $footerMenuService)
    {
        $this->authorize('destroy', FooterMenu::class);
        
        $isDelete = $footerMenuService->destroy($footerMenu->id);
        
        if($isDelete){
            return redirect(route('admin.footer.menu.index'));
        }
    }
}
