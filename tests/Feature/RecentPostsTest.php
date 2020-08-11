<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecentPostsTest extends TestCase
{
    /**
     * Тест проверяет отображение страницы последних постов
     * @return void
     */
    public function testView()
    {
        $response = $this->get(route('recent.Posts.index'));
        
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('posts', ['id' => 1]);
    }
}
