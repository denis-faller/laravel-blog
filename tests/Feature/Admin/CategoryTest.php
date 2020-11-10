<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\CategoryService;
use Blog\Models\Site;
use Blog\Models\Category;
use Illuminate\Support\Facades\Hash;

class CategoryTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы категорий
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.category.index'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет отображение страницы создания категории
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.category.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет создание новой категории
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $categoryName = $this->faker->userName;
        
        $categoryUrl = $this->faker->url();
        
        $response = $this->post(route('admin.category.store'), ['name' => $categoryName, 'url' => $categoryUrl, 'description' => $categoryUrl]);
        
        $categoryService = app(CategoryService::class);
        
        $category = $categoryService->findByUrl($categoryUrl);
        
        $response->assertLocation(route('admin.category.show', $category->id));
        
        $this->assertDatabaseHas('categories', ['url' => $categoryUrl]);
        
        $categoryService->destroy($category->id);
    }
    
    /**
     * Тест проверяет отображение страницы категории
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.category.show', Category::CATEGORY_POLITIC_ID));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных категории
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $categoryName = $this->faker->userName;
        
        $categoryUrl = $this->faker->url();
        
        $response = $this->post(route('admin.category.update', Category::CATEGORY_POLITIC_ID), ['_method'=>'PUT', 'id' => Category::CATEGORY_POLITIC_ID, 'name' => $categoryName, 'url' => $categoryUrl, 'description' => $categoryUrl]);
        
        $response->assertLocation(route('admin.category.show', Category::CATEGORY_POLITIC_ID));
        
        $this->assertDatabaseHas('categories', ['url' => $categoryUrl]);
        
        $categoryService = app(CategoryService::class);
        
        $categoryService->update(Category::CATEGORY_POLITIC_ID, ['name' => 'Политика', 'url' => 'politics', 'description' => 'politics']);
    }
    
    /**
     * Тест проверяет удаление категории
     * @return void
     */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $categoryName = $this->faker->userName;
        
        $categoryUrl = $this->faker->url();
        
        $categoryService = app(CategoryService::class);
        
        $categoryCreated = $categoryService->create(array('site_id' => Site::MAIN_SITE_ID, 
            'name' => $categoryName, 
            'url' => $categoryUrl, 
            'description' => $categoryUrl));
        
        $response = $this->post(route('admin.category.destroy', $categoryCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.category.index'));
    }
}