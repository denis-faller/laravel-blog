<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Blog\Models\AboutPage;

class AboutPageTest extends TestCase
{
    /**
     * Тест проверяет отображение страницы информации о блоге
     * @return void
     */
    public function testView()
    {
        $response = $this->get(route('about.index'));
        
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('about_page', ['id' => AboutPage::ABOUT_PAGE_ID]);
    }
}
