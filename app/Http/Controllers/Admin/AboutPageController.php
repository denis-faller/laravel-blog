<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\AboutPageService;
use Blog\Http\Controllers\Controller;
use Blog\Models\AboutPage;
use Blog\Models\Site;
use Blog\Http\Requests\AboutPageRequest;

/** 
 * Контроллер для работы со страницей о нас
 */
class AboutPageController extends Controller
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
    * Возвращает представление страницы редактирования страницы о нас
    * @param AboutPageService $aboutPageService
    * @return Illuminate\Support\Facades\View
    */  
    public function show(AboutPageService $aboutPageService)
    {
        $this->authorize('show', AboutPage::class);
        
        $aboutPageCollection = $aboutPageService->all();
        
        $aboutPage = $aboutPageCollection->first();
        
        $title = 'Информация о странице о нас';
        $description = 'Информация о странице о нас';
        
        return view('admin.aboutpage.show', ['title' => $title, 
           'description' => $description,
           'aboutPage' => $aboutPage]);
    }
    
    /**
    * Обновляет контент на странице о нас
    * @param AboutPage $aboutPage
    * @param AboutPageRequest $request
    * @param AboutPageService $aboutPageService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(AboutPage $aboutPage, AboutPageRequest $request, AboutPageService $aboutPageService)
    {
        $this->authorize('update', AboutPage::class);
        
        if(isset($request->title_img)){
            $titleImgName = $request->title_img->hashName();

            $request->title_img->move(public_path('assets/images'), $titleImgName);

            $titleImgPath = '/assets/images/'.$titleImgName;
        }
        else{
            $titleImgPath = $aboutPage->title_img;
        }
        
        if(isset($request->after_title_img)){
            $afterTitleImgName = $request->after_title_img->hashName();

            $request->after_title_img->move(public_path('assets/images'), $afterTitleImgName);

            $afterTitleImgPath = '/assets/images/'.$afterTitleImgName;
        }
        else{
            $afterTitleImgPath = $aboutPage->after_title_img;
        }
        
        if(isset($request->after_team_img)){
            $afterTeamImgName = $request->after_team_img->hashName();

            $request->after_team_img->move(public_path('assets/images'), $afterTeamImgName);

            $afterTeamImgPath = '/assets/images/'.$afterTitleImgName;
        }
        else{
            $afterTeamImgPath = $aboutPage->after_team_img;
        }
        
        $aboutPageUpdated = $aboutPageService->update($aboutPage->id, array(
            'title_text' => $request->title_text, 
            'title_img' => $titleImgPath, 
            'after_title_text' => $request->after_title_text, 
            'after_title_img' => $afterTitleImgPath,
            'team_title_text' => $request->team_title_text,
            'after_team_text' => $request->after_team_text,
            'after_team_img' => $afterTeamImgPath));
        
        if(isset($aboutPageUpdated->id)){
            return redirect(route('admin.aboutpage.show', $aboutPage->id));
        }
    }
}
