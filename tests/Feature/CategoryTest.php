<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Blog\Services\CategoryService;

class CategoryTest extends TestCase
{
    /**
     * Тест проверяет отображение страницы категории
     * @return void
     */
    public function testView()
    {
        $categoryService = app(CategoryService::class);
        $urlCategory = $categoryService->find(1)->url;
        
        $response = $this->get(route('category.show',  $urlCategory).'?page=1');
        
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('categories', ['id' => 1]);
    }
}
