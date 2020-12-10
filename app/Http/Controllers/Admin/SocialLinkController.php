<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\SocialLinkService;
use Blog\Http\Controllers\Controller;
use Blog\Models\SocialLink;
use Blog\Models\Site;
use Blog\Http\Requests\SocialLinkRequest;

/** 
 * Контроллер для работы с социальными ссылками
 */
class SocialLinkController extends Controller
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
    * Возвращает представление страницы социальных ссылок
    * @param Request $request
    * @param SocialLinkService $socialLinkService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, SocialLinkService $socialLinkService)
    {
        $this->authorize('index', SocialLink::class);
        
        $paginateSocialLink = $socialLinkService->paginated(9);
        
        if($request->page < 0 || $request->page > $paginateSocialLink->lastPage()){
            abort(404);
        }
        $currentPage = $paginateSocialLink->currentPage();
        
        $socialLinks = $paginateSocialLink->all();
        
        $title = 'Социальные ссылки блога - страница '.$currentPage;
        $description = 'Социальные ссылки блога - страница '.$currentPage;
        
        return view('admin.social.link.index', ['title' => $title, 
           'description' => $description,
           'itemsLinks' => $socialLinks,
           'paginateSocialLink' => $paginateSocialLink]);
    }
    
    /**
    * Возвращает представление страницы создания пункта нижнего меню
    * @param FooterMenuService $footerMenuService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(SocialLinkService $socialLinkService)
    {
        $this->authorize('create', SocialLink::class);

        $title = 'Создание новой социальной ссылки';
        $description = 'Создание новой социальной ссылки';
        return view('admin.social.link.create', [
           'title' => $title, 
           'description' => $description]);
    }
    
    /**
    * Создает социальную ссылку
    * @param SocialLinkRequest $request
    * @param SocialLinkService $socialLinkService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(SocialLinkRequest $request, SocialLinkService $socialLinkService)
    {
        $this->authorize('store', SocialLink::class);
        
        $socialLinkCreated = $socialLinkService->create(array(
            'site_id' => Site::MAIN_SITE_ID, 
            'name' => $request->name, 
            'href' => $request->href, 
            'sort' => $request->sort));
     
        if(isset($socialLinkCreated->id)){
            return redirect(route('admin.social.link.show', $socialLinkCreated->id));
        }
    }
    
    /**
    * Возвращает представление страницы социальной ссылки
    * @param SocialLink $socialLink
    * @return Illuminate\Support\Facades\View
    */
    public function show(SocialLink $socialLink)
    {
        $this->authorize('show', SocialLink::class);
        
        $title = 'Страница социальной ссылки '.$socialLink->name;
        $description = 'Страница социальной ссылки '.$socialLink->name;
        
        return view('admin.social.link.show', ['title' => $title, 
           'description' => $description,
           'socialLink' => $socialLink]);
    }
    
    /**
    * Обновляет информацию о социальной ссылки
    * @param SocialLink $footerMenu
    * @param SocialLinkRequest $request
    * @param SocialLinkService $socialLinkService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(SocialLink $socialLink, SocialLinkRequest $request, SocialLinkService $socialLinkService)
    {
        $this->authorize('update', SocialLink::class);
        
        $socialLinkUpdated = $socialLinkService->update($socialLink->id, array(
            'site_id' => Site::MAIN_SITE_ID, 
            'name' => $request->name, 
            'href' => $request->href, 
            'sort' => $request->sort));
        
        if(isset($socialLinkUpdated->id)){
            return redirect(route('admin.social.link.show', $socialLink->id));
        }
    }
    
    /**
    * Удаляет социальную ссылку
    * @param SocialLink $socialLink
    * @param SocialLinkService $socialLinkService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(SocialLink $socialLink, SocialLinkService $socialLinkService)
    {
        $this->authorize('destroy', SocialLink::class);
        
        $isDelete = $socialLinkService->destroy($socialLink->id);
        
        if($isDelete){
            return redirect(route('admin.social.link.index'));
        }
    }
}
