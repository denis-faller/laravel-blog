<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\MailingService;
use Blog\Services\PostService;
use Blog\Services\SubscriberService;
use Blog\Http\Controllers\Controller;
use Blog\Models\Mailing;
use Blog\Models\Site;
use Blog\Http\Requests\MailingRequest;
use Blog\Jobs\SendMailingJob;

/** 
 * Контроллер для работы с рассылками
 */
class MailingController extends Controller
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
    * Возвращает представление страницы рассылок
    * @param Request $request
    * @param MailingService $mailingService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Mailing $request, MailingService $mailingService)
    {
        $this->authorize('index', Mailing::class);
        
        $paginateMailings = $mailingService->paginated(9);
        
        if($request->page < 0 || $request->page > $paginateMailings->lastPage()){
            abort(404);
        }
        $currentPage = $paginateMailings->currentPage();
        
        $mailings = $paginateMailings->all();
        
        $title = 'Рассылки блога - страница '.$currentPage;
        $description = 'Рассылки блога - страница '.$currentPage;
        
        return view('admin.mailings.index', ['title' => $title, 
           'description' => $description,
           'mailings' => $mailings,
           'paginateMailings' => $paginateMailings]);
    }
        
    /**
    * Возвращает представление страницы создания новой рассылки
    * @param MailingService $mailingService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(MailingService $mailingService)
    {
        $this->authorize('create', Mailing::class);
        
        $postService = app(PostService::class);
        
        $posts = $postService->all();

        $title = 'Создание новой рассылки';
        $description = 'Создание новой рассылки';
        return view('admin.mailings.create', [
           'title' => $title, 
           'description' => $description,
            'posts' => $posts]);
    }
    
    /**
    * Создает рассылку
    * @param MailingRequest $request
    * @param MailingService $mailingService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(MailingRequest $request, MailingService $mailingService)
    {
        $this->authorize('store', Mailing::class);
        
        $postID = NULL;
        if(isset($request->posts[0])){
            $postID = intval($request->posts[0]);
        }
        
        $date = \Carbon\Carbon::now();
        $mailingCreated = $mailingService->create(array(
            'site_id' => Site::MAIN_SITE_ID,
            'post_id' => $postID,
            'send_time' => $date));
        
        $postService = app(PostService::class);
        
        $post = $postService->find($postID);
        
        $subscriberService = app(SubscriberService::class);
        
        $subscribers = $subscriberService->all();
        
        foreach($subscribers as $subscriber){
            $emailJob = (new SendMailingJob($subscriber->email, $post->name, $post->url, $post->text))->delay(now()->addSeconds(3));
            dispatch($emailJob);
        }
     
        if(isset($mailingCreated->id)){
            return redirect(route('admin.mailings.show', $mailingCreated->id));
        }
    }
       
    /**
    * Возвращает представление страницы рассылки
    * @param Mailing $mailing
    * @return Illuminate\Support\Facades\View
    */
    public function show(Mailing $mailing)
    {
        $this->authorize('show', Mailing::class);
        
        $title = 'Страница рассылки '.$mailing->post->name;
        $description = 'Страница рассылки '.$mailing->post->name;
        
        $postService = app(PostService::class);
        
        $posts = $postService->all();
        
        return view('admin.mailings.show', ['title' => $title, 
           'description' => $description,
           'mailing' => $mailing,
           'posts' => $posts]);
    }
    
          
    /**
    * Обновляет информацию о рассылке
    * @param Mailing $mailing
    * @param MailingRequest $request
    * @param MailingService $mailingService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(Mailing $mailing, MailingRequest $request, MailingService $mailingService)
    {
        $this->authorize('update', Mailing::class);
        
        $postID = NULL;
        if(isset($request->posts[0])){
            $postID = $request->posts[0];
        }
        
        $mailingUpdated = $mailingService->update($mailing->id, array(
            'post_id' => $postID));
        
        if(isset($mailingUpdated->id)){
            return redirect(route('admin.mailings.show', $mailing->id));
        }
    }
    
          
    /**
    * Удаляет рассылку
    * @param Mailing $mailing
    * @param MailingService $mailingService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(Mailing $mailing, MailingService $mailingService)
    {
        $this->authorize('destroy', Mailing::class);
        
        $isDelete = $mailingService->destroy($mailing->id);
        
        if($isDelete){
            return redirect(route('admin.mailings.index'));
        }
    }
}