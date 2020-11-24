<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\CommentService;
use Blog\Http\Controllers\Controller;
use Blog\Models\Comment;
use Blog\Models\Site;
use Blog\Services\PostService;
use Blog\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;


/** 
 * Контроллер для работы с комментариями из админки
 */
class CommentController extends Controller
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
    * Возвращает представление страницы комментариев
    * @param Request $request
    * @param CommentService $commentService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, CommentService $commentService)
    {
        $this->authorize('index', Comment::class);
        
        $paginateComments = $commentService->getPaginatedComment(9);
        
        if($request->page < 0 || $request->page > $paginateComments->lastPage()){
            abort(404);
        }
        $currentPage = $paginateComments->currentPage();
        
        $comments = $paginateComments->all();
        $title = 'Комментарии блога - страница '.$currentPage;
        $description = 'Все комментарии блога - страница '.$currentPage;
        
        return view('admin.comments.index', ['title' => $title, 
           'description' => $description,
           'comments' => $comments,
           'paginateComments' => $paginateComments]);
    }
    
    /**
    * Возвращает представление страницы создания комментария
    * @param CommentService $commentService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(CommentService $commentService)
    {
        $this->authorize('create', Comment::class);
        
        $postService = app(PostService::class);
        
        $posts = $postService->all();

        $title = 'Создание нового комментария';
        $description = 'Создание нового комментария';
        
        return view('admin.comments.create', ['title' => $title, 
           'description' => $description,
           'posts' => $posts]);
    }
    
    /**
    * Возвращает комментарии поста
    * @param Request $request
    * @param CommentService $commentService
    * @return json
    */  
    public function commentsOnPost(Request $request, CommentService $commentService)
    {
        $this->authorize('commentsOnPost', Comment::class);
        
        $postID = intval($request->postID);
        
        if($postID < 0){
            abort(404);
        }
        
        $comments = $commentService->findByPostID($postID);
        
        return json_encode($comments);
    }
    
    /**
    * Возвращает комментарии поста
    * @param Request $request
    * @param CommentService $commentService
    * @return json
    */  
    public function commentsOnPostAndCondition(Request $request, CommentService $commentService)
    {
        $this->authorize('commentsOnPost', Comment::class);
        
        $postID = intval($request->postID);
        $commentID = intval($request->commentID);
        
        if($postID < 0){
            abort(404);
        }
        
        $comments = $commentService->getCommentsByPostIdAndCondition($postID, $commentID);
        
        return json_encode($comments);
    }
    
    /**
    * Создает новый комментарий
    * @param PostRequest $request
    * @param CommentService $commentService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(CommentRequest $request, CommentService $commentService)
    {
        $this->authorize('store', Comment::class);
        
        $parentID = NULL;
        if(isset($request->parent_comments[0])){
            $parentID = $request->parent_comments[0];
        }
        
        $commentCreated = $commentService->create(array(
            'author_id' => Auth::user()->id,
            'post_id' => $request->posts[0], 
            'parent_id' => $parentID, 
            'name' => NULL, 
            'email' => NULL, 
            'website' => NULL, 
            'message' => $request->message));
        
        if(isset($commentCreated->id)){
            return redirect(route('admin.comments.show', $commentCreated->id));
        }
        else{
            abort(404);
        }
    }
    
    /**
    * Возвращает представление страницы редактирования комментария
    * @param Comment $comment
    * @param CommentService $commentService
    * @return Illuminate\Support\Facades\View
    */
    public function show(Comment $comment, CommentService $commentService, PostService $postService)
    {
        $this->authorize('show', $comment);
        
        $posts = $postService->all();
        
        $commentsOnPost = $commentService->getCommentsByPostIdAndCondition($comment->post_id, $comment->id);
        
        $title = 'Страница комментария с id '.$comment->id;
        $description = 'Детальная страница комментария с id '.$comment->id;
        return view('admin.comments.show', ['title' => $title, 
           'description' => $description,
           'comment' => $comment,
           'posts' => $posts,
           'commentsOnPost' => $commentsOnPost]);
    }
    
    /**
    * Обновляет комментарий
    * @param Comment $comment
    * @param CommentRequest $request
    * @param CommentService $commentService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(Comment $comment, CommentRequest $request, CommentService $commentService)
    {
        $this->authorize('update', Comment::class);
        
        $parentID = NULL;
        if(isset($request->parent_comments[0])){
            $parentID = $request->parent_comments[0];
        }
        
        $commentUpdated = $commentService->update($comment->id, array(
            'author_id' => Auth::user()->id,
            'post_id' => $request->posts[0], 
            'parent_id' => $parentID, 
            'name' => NULL, 
            'email' => NULL, 
            'website' => NULL, 
            'message' => $request->message));
     
        if(isset($commentUpdated->id)){
            return redirect(route('admin.comments.show', $commentUpdated->id));
        }
    }
    
        
    /**
    * Удаляет комментарий
    * @param Comment $comment
    * @param CommentService $commentService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(Comment $comment, CommentService $commentService)
    {
        $this->authorize('destroy', Comment::class);
        
        $isDelete = $commentService->destroy($comment->id);
        
        if($isDelete){
            return redirect(route('admin.comments.index'));
        }
    }
}