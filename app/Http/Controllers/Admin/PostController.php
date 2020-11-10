<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\PostService;
use Blog\Http\Controllers\Controller;
use Blog\Models\Post;
use Blog\Models\Site;
use Blog\Services\TagService;
use Blog\Services\CategoryService;
use Blog\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;


/** 
 * Контроллер для работы с постами из админки
 */
class PostController extends Controller
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
    * Возвращает представление страницы постов
    * @param Request $request
    * @param PostService $postService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, PostService $postService)
    {
        $this->authorize('index', Post::class);
        
        $paginatePosts = $postService->paginated(9);
        
        if($request->page < 0 || $request->page > $paginatePosts->lastPage()){
            abort(404);
        }
        $currentPage = $paginatePosts->currentPage();
        
        $posts = $paginatePosts->all();
        $title = 'Посты блога - страница '.$currentPage;
        $description = 'Все посты блога - страница '.$currentPage;
        
        return view('admin.posts.index', ['title' => $title, 
           'description' => $description,
           'posts' => $posts,
           'paginatePosts' => $paginatePosts]);
    }
        
    /**
    * Возвращает представление страницы создания поста
    * @param PostService $postService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(PostService $postService)
    {
        $this->authorize('create', Post::class);
        
        $categoryService = app(CategoryService::class);
        
        $categories = $categoryService->all();
        
        $tagService = app(TagService::class);
        
        $tags = $tagService->all();

        $title = 'Создание нового поста';
        $description = 'Создание нового поста';
        return view('admin.posts.create', ['title' => $title, 
           'description' => $description,
           'categories' => $categories,
           'tags' => $tags]);
    }
    
    /**
    * Создает пост
    * @param PostRequest $request
    * @param PostService $postService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(PostRequest $request, PostService $postService)
    {
        $this->authorize('store', Post::class);
        
        if(empty($request->main_page)){
            $request->main_page = 0;
        }
        
        if(isset($request->preview)){
            $previewName = $request->preview->hashName();

            $request->preview->move(public_path('assets/images'), $previewName);

            $previewPath = '/assets/images/'.$previewName;
        }
        else{
            $previewPath = "";
        }
        
        if(isset($request->image)){
            $imageName = $request->image->hashName();

            $request->image->move(public_path('assets/images'), $imageName);

            $imagePath = '/assets/images/'.$imageName;
        }
        else{
            $imagePath = "";
        }
        
        $postCreated = $postService->create(array('site_id' => Site::MAIN_SITE_ID, 
            'main_page' => $request->main_page, 
            'name' => $request->name, 
            'url' => $request->url, 
            'publish_time' => date('Y-m-d H:i:s', time()), 
            'preview_img' => $previewPath, 
            'img' => $imagePath, 
            'view_count' => 0, 
            'category_id' => $request->categories[0], 
            'author_id' => Auth::user()->id, 
            'text' => $request->text));
     
        if(isset($postCreated->id)){
            if(isset($request->tags)){
                $postCreated->tags()->sync($request->tags);
            }
            return redirect(route('admin.posts.show', $postCreated->id));
        }
    }
    
    /**
    * Возвращает представление страницы редактирования поста
    * @param Post $post
    * @param PostService $postService
    * @return Illuminate\Support\Facades\View
    */  
    public function show(Post $post, PostService $postService, CategoryService $categoryService, TagService $tagService)
    {
        $this->authorize('show', $post);
        
        $categories = $categoryService->all();
        
        $tags = $tagService->all();
        
        $postTagsIDs = array(); 
        foreach($post->tags as $tag){
            $postTagsIDs[] = $tag->id;
        }
        
        $title = 'Страница поста '.$post->name;
        $description = 'Детальная страница поста '.$post->name;
        return view('admin.posts.show', ['title' => $title, 
           'description' => $description,
           'post' => $post,
           'categories' => $categories,
           'tags' => $tags,
           'postTagsIDs' => $postTagsIDs]);
    }
    
    /**
    * Обновляет пост
    * @param PostRequest $request
    * @param PostService $postService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(Post $post, PostRequest $request, PostService $postService)
    {
        $this->authorize('update', Post::class);
        
        if(empty($request->main_page)){
            $request->main_page = 0;
        }
        
        if(isset($request->preview)){
            $previewName = $request->preview->hashName();

            $request->preview->move(public_path('assets/images'), $previewName);

            $previewPath = '/assets/images/'.$previewName;
        }
        else{
            $previewPath = $post->preview_img;
        }
        
        if(isset($request->image)){
            $imageName = $request->image->hashName();

            $request->image->move(public_path('assets/images'), $imageName);

            $imagePath = '/assets/images/'.$imageName;
        }
        else{
            $imagePath = $post->img;
        }
        
        $postUpdated = $postService->update($post->id, array('site_id' => Site::MAIN_SITE_ID, 
            'main_page' => $request->main_page, 
            'name' => $request->name, 
            'url' => $request->url, 
            'publish_time' => $post->publish_time, 
            'preview_img' => $previewPath, 
            'img' => $imagePath, 
            'view_count' => $post->view_count, 
            'category_id' => $request->categories[0], 
            'author_id' => $post->author_id, 
            'text' => $request->text));
     
        if(isset($postUpdated->id)){
            if(isset($request->tags)){
                $postUpdated->tags()->sync($request->tags);
            }
            return redirect(route('admin.posts.show', $post->id));
        }
    }
    
    /**
    * Удаляет пост
    * @param Post $post
    * @param PostService $postService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(Post $post, PostService $postService)
    {
        $this->authorize('destroy', Post::class);
        
        $isDelete = $postService->destroy($post->id);
        
        if($isDelete){
            return redirect(route('admin.posts.index'));
        }
    }
}
