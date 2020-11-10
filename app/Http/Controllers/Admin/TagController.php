<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\PostService;
use Blog\Services\TagService;
use Blog\Http\Controllers\Controller;
use Blog\Models\Tag;
use Blog\Models\Site;
use Blog\Http\Requests\TagRequest;

/** 
 * Контроллер для работы с тегами из админки
 */
class TagController extends Controller
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
    * Возвращает представление страницы тегов
    * @param Request $request
    * @param TagService $tagService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, TagService $tagService)
    {
        $this->authorize('index', Tag::class);
        
        $paginateTags = $tagService->paginated(9);
        
        if($request->page < 0 || $request->page > $paginateTags->lastPage()){
            abort(404);
        }
        $currentPage = $paginateTags->currentPage();
        
        $tags = $paginateTags->all();
        $title = 'Теги блога - страница '.$currentPage;
        $description = 'Все теги блога - страница '.$currentPage;
        
        return view('admin.tags.index', ['title' => $title, 
           'description' => $description,
            'tags' => $tags,
            'paginateTags' => $paginateTags]);
    }
    
    /**
    * Возвращает представление страницы создания тега
    * @param TagService $tagService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(TagService $tagService)
    {
        $this->authorize('create', Tag::class);

        $title = 'Создание нового тега';
        $description = 'Создание нового тега блога';
        return view('admin.tags.create', ['title' => $title, 
           'description' => $description]);
    }
    
    /**
    * Создает тег
    * @param TagRequest $request
    * @param TagService $tagService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(TagRequest $request, TagService $tagService)
    {
        $this->authorize('store', Tag::class);
        
        $tagCreated = $tagService->create(array('site_id' => Site::MAIN_SITE_ID, 'name' => $request->name, 'url' => $request->url, 'color' => $request->color));
     
        if(isset($tagCreated->id)){
            return redirect(route('admin.tags.show', $tagCreated->id));
        }
    }
    
    /**
    * Возвращает представление страницы тега
    * @param Tag $tag
    * @return Illuminate\Support\Facades\View
    */  
    public function show(Tag $tag)
    {
        $this->authorize('show', Tag::class);
        
        $title = 'Страница тега '.$tag->name;
        $description = 'Страница тега '.$tag->name;
        return view('admin.tags.show', ['title' => $title, 
           'description' => $description,
            'tag' => $tag]);
    }
    
     /**
    * Обновляет информацию о теге
    * @param Tag $tag
    * @param TagRequest $request
    * @param TagService $tagService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(Tag $tag, TagRequest $request, TagService $tagService)
    {
        $this->authorize('update', Tag::class);
        
        $tagUpdated = $tagService->update($tag->id, array('name' => $request->name, 'url' => $request->url, 'color' => $request->color));
        
        if(isset($tagUpdated->id)){
            return redirect(route('admin.tags.show', $tag->id));
        }
    }
    
    /**
    * Удаляет тег
    * @param Tag $tag
    * @param TagService $tagService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(Tag $tag, TagService $tagService)
    {
        $this->authorize('destroy', Tag::class);
        
        $isDelete = $tagService->destroy($tag->id);
        
        if($isDelete){
            return redirect(route('admin.tags.index'));
        }
    }
}
