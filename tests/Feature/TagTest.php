<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Blog\Services\TagService;

class TagTest extends TestCase
{
    /**
     * Тест проверяет отображение страницы тега
     * @return void
     */
    public function testView()
    {
        $tagService = app(TagService::class);
        $urlTag = $tagService->find(1)->url;
        
        $response = $this->get(route('tags.show',  $urlTag).'?page=1');
        
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('tags', ['id' => 1]);
    }
}
