<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\SiteService;
use Blog\Http\Controllers\Controller;
use Blog\Models\Site;
use Blog\Http\Requests\SiteRequest;

/** 
 * Контроллер для работы со страницей сайта
 */
class SiteController extends Controller
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
    * Возвращает представление страницы редактирования сайта
    * @param SiteService $siteService
    * @return Illuminate\Support\Facades\View
    */  
    public function show(SiteService $siteService)
    {
        $this->authorize('show', Site::class);
        
        $siteCollection = $siteService->all();
        
        $site = $siteCollection->first();
        
        $title = 'Информация о сайте';
        $description = 'Информация о сайте';
        
        return view('admin.site.show', ['title' => $title, 
           'description' => $description,
           'site' => $site]);
    }
    
     
    /**
    * Обновляет информацию о сайте
    * @param Site $site
    * @param SiteRequest $request
    * @param SiteService $siteService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(Site $site, SiteRequest $request, SiteService $siteService)
    {
        $this->authorize('update', Site::class);
        
        $siteUpdated = $siteService->update($site->id, array(
            'name' => $request->name,
            'footer_text' => $request->footer_text));
        
        if(isset($siteUpdated->id)){
            return redirect(route('admin.site.show', $site->id));
        }
    }
}