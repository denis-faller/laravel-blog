<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\SiteService;
use Blog\Models\Site;
use Illuminate\Support\Facades\Hash;

class SiteTest extends TestCase
{
    use WithFaker;
    /**
     * Тест проверяет отображение страницы редактирования сайта
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.site.show', Site::MAIN_SITE_ID));
        
        $response->assertStatus(200);
    }
    
        
    /**
     * Тест проверяет обновления данных сайта
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $name = $this->faker->userName;
        $footerText = $this->faker->userName;
        
        $response = $this->post(route('admin.site.update', Site::MAIN_SITE_ID), ['_method'=>'PUT', 
            'name' => $name, 
            'footer_text' => $footerText]);
        
        $response->assertLocation(route('admin.site.show', Site::MAIN_SITE_ID));
        
        $this->assertDatabaseHas('sites', ['name' => $name]);
        
        $siteService = app(SiteService::class);
        
        $siteService->update(Site::MAIN_SITE_ID, [
            'name' => 'Блог компании',
            'footer_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat reprehenderit magnam deleniti quasi saepe, consequatur atque sequi delectus dolore veritatis obcaecati quae, repellat eveniet omnis, voluptatem in. Soluta, eligendi, architecto.',
        ]);
    }
}