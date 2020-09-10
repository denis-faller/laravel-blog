<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Blog\Services\PostService;

class PostTest extends TestCase
{
    use WithFaker;
    /**
     * Тест проверяет отображение страницы поста
     * @return void
     */
    public function testView()
    {
        $postService = app(PostService::class);
        $urlPost = $postService->find(1)->url;
        
        $response = $this->get(route('post.show',  $urlPost));
        
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('posts', ['id' => 1]);
    }
}
