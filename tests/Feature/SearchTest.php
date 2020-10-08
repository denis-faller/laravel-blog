<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchTest extends TestCase
{
    /**
     * Тест проверяет отображение страницы поиска
     * @return void
     */
    public function testView()
    {
        $response = $this->get(route('search.index')."?q=AI magically removes");
        
        $response->assertStatus(200);
    }
}
