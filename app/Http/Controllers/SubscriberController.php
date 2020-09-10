<?php

namespace Blog\Http\Controllers;

use Blog\Http\Requests\SubscriberAddRequest;
use Blog\Services\SubscriberService;
use Blog\Models\Site;

/** 
 * Контроллер для подписки
 */
class SubscriberController extends Controller
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
    * Добавляет нового подписчика
    * @param SubscriberAddRequest $request
    * @param SubscriberService $subscriberService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(SubscriberAddRequest $request, SubscriberService $subscriberService)
    {
        $subscriberService->create(array( 
            'site_id' => Site::MAIN_SITE_ID, 
            'email' => $request->email));
            return redirect(url()->previous());
    } 
}
