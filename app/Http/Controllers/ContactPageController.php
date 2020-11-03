<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Services\ContactPageService;
use Blog\Models\ContactPage;
use Blog\Http\Requests\ContactFormRequest;
use Blog\Jobs\SendContactFormJob;

/** 
 * Контроллер для вывода страницы контактов
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
    * Возвращает представление страницы контактов
    * @param ContactPageService $contactPageService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(ContactPageService $contactPageService)
    {
        $contactPage = $contactPageService->find(ContactPage::CONTACT_PAGE_ID);
        
        return view('contact', ['title' => 'Контакты', 
           'description' => 'Контактная информация блога',
            'contactPage' => $contactPage]);
    }
    
    /**
    * Отправляет письмо с данными из формы контактов
    * @param ContactFormRequest $request
    * @return Illuminate\Routing\Redirector
    */  
    public function send(ContactFormRequest $request){
        
        $emailJob = (new SendContactFormJob($request->first_name, $request->last_name, $request->email, $request->subject, $request->message))->delay(now()->addSeconds(3));
        dispatch($emailJob);
        
        return redirect(route('contact.index'));
    }
        
}
