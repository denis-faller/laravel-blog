<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\HeaderMenuService;
use Blog\Models\Site;
use Blog\Models\HeaderMenu;
use Illuminate\Support\Facades\Hash;

class HeaderMenuTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы пунктов верхнего меню
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.header.menu.index'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет отображение страницы создания пункта верхнего меню
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.header.menu.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет создание нового пункта меню
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
        
        $response = $this->post(route('admin.header.menu.store'), ['name' => $itemMenuName, 'url' => $itemMenuUrl, 'sort' => 500]);
        
        $headerMenuService = app(HeaderMenuService::class);
        
        $itemMenu = $headerMenuService->findByUrl($itemMenuUrl);
        
        $response->assertLocation(route('admin.header.menu.show', $itemMenu->id));
        
        $this->assertDatabaseHas('header_menus', ['url' => $itemMenu->url]);
        
        $headerMenuService->destroy($itemMenu->id);
    }
    
    /**
     * Тест проверяет отображение страницы пункта меню
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.header.menu.show', HeaderMenu::ITEM_MENU_MAIN));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных пункта меню
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
        
        $response = $this->post(route('admin.header.menu.update', HeaderMenu::ITEM_MENU_MAIN), ['_method'=>'PUT', 
            'name' => $itemMenuName, 
            'url' => $itemMenuUrl, 
            'sort' => 500]);
        
        $response->assertLocation(route('admin.header.menu.show', HeaderMenu::ITEM_MENU_MAIN));
        
        $this->assertDatabaseHas('header_menus', ['url' => $itemMenuUrl]);
        
        $headerMenuService = app(HeaderMenuService::class);
        
        $headerMenuService->update(HeaderMenu::ITEM_MENU_MAIN, [
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
        
        $headerMenuService = app(HeaderMenuService::class);
        
        $itemMenuCreated = $headerMenuService->create(array(
            'site_id' => Site::MAIN_SITE_ID, 
            'name' => $itemMenuName, 
            'url' => $itemMenuUrl, 
            'sort' => 100));
        
        $response = $this->post(route('admin.header.menu.destroy', $itemMenuCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.header.menu.index'));
    }
}