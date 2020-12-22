<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\FooterMenuService;
use Blog\Models\Site;
use Blog\Models\FooterMenu;
use Illuminate\Support\Facades\Hash;

class FooterMenuTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы пунктов нижнего меню
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.footer.menu.index'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет отображение страницы создания пункта нижнего меню
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.footer.menu.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет создание нового пункта нижнего меню
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $itemMenuName = $this->faker->userName;
        
        $itemMenuUrl = $this->faker->url();
        
        $response = $this->post(route('admin.footer.menu.store'), [
            'name' => $itemMenuName, 
            'url' => $itemMenuUrl, 
            'sort' => 500]);
        
        $footerMenuService = app(FooterMenuService::class);
        
        $itemMenu = $footerMenuService->findByUrl($itemMenuUrl);
        
        $response->assertLocation(route('admin.footer.menu.show', $itemMenu->id));
        
        $this->assertDatabaseHas('footer_menu', ['url' => $itemMenu->url]);
        
        $footerMenuService->destroy($itemMenu->id);
    }
    
    /**
     * Тест проверяет отображение страницы пункта нижнего меню
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.footer.menu.show', FooterMenu::ITEM_MENU_MAIN));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных пункта нижнего меню
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $itemMenuName = $this->faker->userName;
        
        $itemMenuUrl = $this->faker->url();
        
        $response = $this->post(route('admin.footer.menu.update', FooterMenu::ITEM_MENU_MAIN), ['_method'=>'PUT', 
            'name' => $itemMenuName, 
            'url' => $itemMenuUrl, 
            'sort' => 500]);
        
        $response->assertLocation(route('admin.footer.menu.show', FooterMenu::ITEM_MENU_MAIN));
        
        $this->assertDatabaseHas('footer_menu', ['url' => $itemMenuUrl]);
        
        $footerMenuService = app(FooterMenuService::class);
        
        $footerMenuService->update(FooterMenu::ITEM_MENU_MAIN, [
            'name' => 'Главная', 
            'url' => '', 
            'sort' => 100]);
    }
    
    /**
     * Тест проверяет удаление пункта меню
     * @return void
     */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $itemMenuName = $this->faker->userName;
        
        $itemMenuUrl = $this->faker->url();
        
        $footerMenuService = app(FooterMenuService::class);
        
        $itemMenuCreated = $footerMenuService->create(array(
            'site_id' => Site::MAIN_SITE_ID, 
            'name' => $itemMenuName, 
            'url' => $itemMenuUrl, 
            'sort' => 100));
        
        $response = $this->post(route('admin.footer.menu.destroy', $itemMenuCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.footer.menu.index'));
    }
}