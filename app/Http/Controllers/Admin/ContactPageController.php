<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\ContactPageService;
use Blog\Http\Controllers\Controller;
use Blog\Models\ContactPage;
use Blog\Models\Site;
use Blog\Http\Requests\ContactPageRequest;

/** 
 * Контроллер для работы со страницей контактов
 */
class ContactPageController extends Controller
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
    * Возвращает представление страницы редактирования страницы контактов
    * @param ContactPageService $contactPageService
    * @return Illuminate\Support\Facades\View
    */  
    public function show(ContactPageService $contactPageService)
    {
        $this->authorize('show', ContactPage::class);
        
        $contactPageCollection = $contactPageService->all();
        
        $contactPage = $contactPageCollection->first();
        
        $title = 'Информация о странице контактов';
        $description = 'Информация о странице контактов';
        
        return view('admin.contactpage.show', ['title' => $title, 
           'description' => $description,
           'contactPage' => $contactPage]);
    }
    
    /**
    * Обновляет контент на странице контактов
    * @param ContactPage $contactPage
    * @param ContactPageRequest $request
    * @param ContactPageService $contactPageService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(ContactPage $contactPage, ContactPageRequest $request, ContactPageService $contactPageService)
    {
        $this->authorize('update', ContactPage::class);
        
        if(isset($request->title_img)){
            $titleImgName = $request->title_img->hashName();

            $request->title_img->move(public_path('assets/images'), $titleImgName);

            $titleImgPath = '/assets/images/'.$titleImgName;
        }
        else{
            $titleImgPath = $contactPage->title_img;
        }
        
        $contactPageUpdated = $contactPageService->update($contactPage->id, array(
            'title_text' => $request->title_text,
            'title_img' => $titleImgPath,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email));
        
        if(isset($contactPageUpdated->id)){
            return redirect(route('admin.contactpage.show', $contactPage->id));
        }
    }
}
