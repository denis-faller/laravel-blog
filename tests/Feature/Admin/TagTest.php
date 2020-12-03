<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\TagService;
use Blog\Models\Site;
use Blog\Models\Tag;
use Illuminate\Support\Facades\Hash;

class TagTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы тегов
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.tags.index'));
        
        $response->assertStatus(200);
    }
    
        
   /**
     * Тест проверяет отображение страницы создания тега
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.tags.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет создание нового тега
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $tagName = $this->faker->userName;
        
        $tagUrl = $this->faker->url();
        
        $response = $this->post(route('admin.tags.store'), ['name' => $tagName, 'url' => $tagUrl, 'color' => $tagUrl]);
        
        $tagService = app(TagService::class);
        
        $tag = $tagService->findByUrl($tagUrl);
        
        $response->assertLocation(route('admin.tags.show', $tag->id));
        
        $this->assertDatabaseHas('tags', ['url' => $tagUrl]);
        
        $tagService->destroy($tag->id);
    }
    
        
    /**
     * Тест проверяет отображение страницы тега
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.tags.show', Tag::TAG_TRAVEL_ID));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных тега
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $tagName = $this->faker->userName;
        
        $tagUrl = $this->faker->url();
        
        $response = $this->post(route('admin.tags.update', Tag::TAG_TRAVEL_ID), ['_method'=>'PUT', 'id' => Tag::TAG_TRAVEL_ID, 'name' => $tagName, 'url' => $tagUrl, 'color' => $tagUrl]);
        
        $response->assertLocation(route('admin.tags.show', Tag::TAG_TRAVEL_ID));
        
        $this->assertDatabaseHas('tags', ['url' => $tagUrl]);
        
        $tagService = app(TagService::class);
        
        $tagService->update(Tag::TAG_TRAVEL_ID, ['name' => 'Путешествия', 'url' => 'travel', 'color' => '#8bc34a']);
    }
    
    /**
     * Тест проверяет удаление тега
     * @return void
     */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $tagName = $this->faker->userName;
        
        $tagUrl = $this->faker->url();
        
        $tagService = app(TagService::class);
        
        $tagCreated = $tagService->create(array('site_id' => Site::MAIN_SITE_ID, 
            'name' => $tagName, 
            'url' => $tagUrl, 
            'color' => ''));
        
        $response = $this->post(route('admin.tags.destroy', $tagCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.tags.index'));
    }
}