<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\SubscriberService;
use Blog\Http\Controllers\Controller;
use Blog\Models\Staff;
use Blog\Models\Subscriber;
use Blog\Models\Site;
use Blog\Http\Requests\SubscriberRequest;

/** 
 * Контроллер для работы с подписчиками
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
    * Возвращает представление страницы подписчиков
    * @param Request $request
    * @param SubscriberService $subscriberService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, SubscriberService $subscriberService)
    {
        $this->authorize('index', Subscriber::class);
        
        $paginateSubscribers = $subscriberService->paginated(9);
        
        if($request->page < 0 || $request->page > $paginateSubscribers->lastPage()){
            abort(404);
        }
        $currentPage = $paginateSubscribers->currentPage();
        
        $subscribers = $paginateSubscribers->all();
        
        $title = 'Подписчики блога - страница '.$currentPage;
        $description = 'Подписчики блога - страница '.$currentPage;
        
        return view('admin.subscribers.index', ['title' => $title, 
           'description' => $description,
           'subscribers' => $subscribers,
           'paginateSubscribers' => $paginateSubscribers]);
    }
    
    /**
    * Возвращает представление страницы создания нового подписчика
    * @param SubscriberService $subscriberService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(SubscriberService $subscriberService)
    {
        $this->authorize('create', Subscriber::class);

        $title = 'Создание нового подписчика блога';
        $description = 'Создание нового подписчика блога';
        return view('admin.subscribers.create', [
           'title' => $title, 
           'description' => $description]);
    }
    
    /**
    * Создает подписчика
    * @param SubscriberRequest $request
    * @param SubscriberService $subscriberService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(SubscriberRequest $request, SubscriberService $subscriberService)
    {
        $this->authorize('store', Subscriber::class);
        
        $subscriberCreated = $subscriberService->create(array(
            'site_id' => Site::MAIN_SITE_ID, 
            'email' => $request->email));
     
        if(isset($subscriberCreated->id)){
            return redirect(route('admin.subscribers.show', $subscriberCreated->id));
        }
    }
    
    /**
    * Возвращает представление страницы подписчика
    * @param Subscriber $subscriber
    * @return Illuminate\Support\Facades\View
    */
    public function show(Subscriber $subscriber)
    {
        $this->authorize('show', Subscriber::class);
        
        $title = 'Страница подписчика '.$subscriber->email;
        $description = 'Страница подписчика '.$subscriber->email;
        
        return view('admin.subscribers.show', ['title' => $title, 
           'description' => $description,
           'subscriber' => $subscriber]);
    }
      
    /**
    * Обновляет информацию о подписчике
    * @param Subscriber $subscriber
    * @param SubscriberRequest $request
    * @param SubscriberService $subscriberService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(Subscriber $subscriber, SubscriberRequest $request, SubscriberService $subscriberService)
    {
        $this->authorize('update', Subscriber::class);
        
        $subscriberUpdated = $subscriberService->update($subscriber->id, array(
            'site_id' => Site::MAIN_SITE_ID, 
            'email' => $request->email));
        
        if(isset($subscriberUpdated->id)){
            return redirect(route('admin.subscribers.show', $subscriber->id));
        }
    }
      
    /**
    * Удаляет подписчика
    * @param Subscriber $subscriber
    * @param SubscriberService $subscriberService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(Subscriber $subscriber, SubscriberService $subscriberService)
    {
        $this->authorize('destroy', Subscriber::class);
        
        $isDelete = $subscriberService->destroy($subscriber->id);
        
        if($isDelete){
            return redirect(route('admin.subscribers.index'));
        }
    }
}
