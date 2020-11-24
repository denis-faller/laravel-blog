<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\CommentService;
use Blog\Models\Comment;
use Blog\Models\Post;
use Illuminate\Support\Facades\Hash;

class CommentTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы комментариев
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.comments.index'));
        
        $response->assertStatus(200);
    }
    
   /**
     * Тест проверяет отображение страницы создания комментария
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.comments.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет создание нового комментария
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $commentMessage = $this->faker->text;
        
        $response = $this->post(route('admin.comments.store'), [
            'posts' => array(Post::AI_REMOVES_POST_ID),
            'message' => $commentMessage]);
        
        $commentService = app(CommentService::class);
        
        $comment = $commentService->findByMessage($commentMessage);
        
        $response->assertLocation(route('admin.comments.show', $comment->id));
        
        $this->assertDatabaseHas('comments', ['message' => $commentMessage]);
        
        $commentService->destroy($comment->id);
    }
    
    /**
     * Тест проверяет отображение страницы редактирования комментария
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.comments.show', Comment::LOREM_IPSUM_COMMENT_ID));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных комментария
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $commentMessage = $this->faker->text;
        
        $response = $this->post(route('admin.comments.update', Comment::LOREM_IPSUM_COMMENT_ID), [
            '_method'=>'PUT', 
            'posts' => array(Comment::LOREM_IPSUM_COMMENT_ID),
            'message' => $commentMessage]);
        
        $response->assertLocation(route('admin.comments.show', Comment::LOREM_IPSUM_COMMENT_ID));
        
        $this->assertDatabaseHas('comments', ['message' => $commentMessage]);
        
        $commentService = app(CommentService::class);
        
        $commentService->update(Comment::LOREM_IPSUM_COMMENT_ID, ['message' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur quidem laborum necessitatibus, ipsam impedit vitae autem, eum officia, fugiat saepe enim sapiente iste iure! Quam voluptas earum impedit necessitatibus, nihil?11']);
    }
    
    /**
     * Тест проверяет удаление комментария
     * @return void
     */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $commentMessage = $this->faker->text;
        
        $commentService = app(CommentService::class);
        
        $commentCreated = $commentService->create(array(
            'author_id' => Auth::user()->id,
            'post_id' => Post::AI_REMOVES_POST_ID, 
            'parent_id' => NULL, 
            'name' => NULL, 
            'email' => NULL, 
            'website' => NULL, 
            'message' => $commentMessage));
        
        $response = $this->post(route('admin.comments.destroy', $commentCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.comments.index'));
    }
}