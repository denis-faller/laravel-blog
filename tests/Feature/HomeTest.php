<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * Тест проверяет отображение страницы информации о сайте
     * @return void
     */
    public function testView()
    {
        $response = $this->get(route('home.index'));
        
        $response->assertStatus(200);
    }
}
