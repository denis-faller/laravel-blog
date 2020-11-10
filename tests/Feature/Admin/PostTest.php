<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\PostService;
use Blog\Models\Site;
use Blog\Models\Post;
use Illuminate\Support\Facades\Hash;
use Blog\Models\Category;

class PostTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы постов
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.posts.index'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет отображение страницы создания поста
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.posts.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет создание нового поста
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $postName = $this->faker->userName;
        
        $postUrl = $this->faker->url();
        
        $response = $this->post(route('admin.posts.store'), ['name' => $postName, 
            'url' => $postUrl,
            'categories' => array(Category::CATEGORY_POLITIC_ID),
            'text' => $postUrl]);
        
        $postService = app(PostService::class);
        
        $post = $postService->findByUrl($postUrl);
        
        $response->assertLocation(route('admin.posts.show', $post->id));
        
        $this->assertDatabaseHas('posts', ['url' => $postUrl]);
        
        $postService->destroy($post->id);
    }
    
    /**
     * Тест проверяет отображение страницы редактирования поста
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.posts.show', Post::AI_REMOVES_POST_ID));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных поста
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $postName = $this->faker->userName;
        
        $postUrl = $this->faker->url();
        
        $response = $this->post(route('admin.posts.update', Post::AI_REMOVES_POST_ID), ['_method'=>'PUT', 
            'id' => Post::AI_REMOVES_POST_ID, 
            'name' => $postName, 
            'url' => $postUrl, 
            'categories' => array(Category::CATEGORY_POLITIC_ID),
            'text' => $postUrl]);
        
        $response->assertLocation(route('admin.posts.show', Post::AI_REMOVES_POST_ID));
        
        $this->assertDatabaseHas('posts', ['url' => $postUrl]);
        
        $postService = app(PostService::class);
        
        $postService->update(Post::AI_REMOVES_POST_ID, ['name' => 'The AI magically removes moving objects from videos.', 'url' => 'ai-removes', 'text' => 'The AI magically removes moving objects from videos.']);
    }
    
    /**
     * Тест проверяет удаление поста
     * @return void
     */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $postName = $this->faker->userName;
        
        $postUrl = $this->faker->url();
        
        $postService = app(PostService::class);
        
        $postCreated = $postService->create(array('site_id' => Site::MAIN_SITE_ID, 
            'main_page' => 0, 
            'name' => $postName, 
            'url' => $postUrl, 
            'publish_time' => date('Y-m-d H:i:s', time()), 
            'preview_img' => '', 
            'img' => '', 
            'view_count' => 0, 
            'category_id' => Category::CATEGORY_POLITIC_ID, 
            'author_id' => Auth::user()->id, 
            'text' => $postUrl));
        
        $response = $this->post(route('admin.posts.destroy', $postCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.posts.index'));
    }
}