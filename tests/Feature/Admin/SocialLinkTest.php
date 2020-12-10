<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\SocialLinkService;
use Blog\Models\Site;
use Blog\Models\SocialLink;
use Illuminate\Support\Facades\Hash;

class SocialLinkTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы социальных ссылок
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.social.link.index'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет отображение страницы создания социальной ссылки
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.social.link.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет создание новой социальной ссылки
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $socialLinkName = $this->faker->userName;
        
        $socialLinkHref = $this->faker->url();
        
        $response = $this->post(route('admin.social.link.store'), [
            'name' => $socialLinkName, 
            'href' => $socialLinkHref,
            'sort' => 500]);
        
        $socialLinkService = app(SocialLinkService::class);
        
        $socialLink = $socialLinkService->findByHref($socialLinkHref);
        
        $response->assertLocation(route('admin.social.link.show', $socialLink->id));
        
        $this->assertDatabaseHas('social_links', ['href' => $socialLink->href]);
        
        $socialLinkService->destroy($socialLink->id);
    }
        
    /**
     * Тест проверяет отображение страницы редактирования социальной ссылки
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.social.link.show', SocialLink::FACEBOOK_LINK_ID));
        
        $response->assertStatus(200);
    }
        
    /**
     * Тест проверяет обновления данных социальной ссылки
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $socialLinkName = $this->faker->userName;
        
        $socialLinkHref = $this->faker->url();
        
        $response = $this->post(route('admin.social.link.update', SocialLink::FACEBOOK_LINK_ID), ['_method'=>'PUT', 
            'name' => $socialLinkName, 
            'href' => $socialLinkHref, 
            'sort' => 500]);
        
        $response->assertLocation(route('admin.social.link.show', SocialLink::FACEBOOK_LINK_ID));
        
        $this->assertDatabaseHas('social_links', ['href' => $socialLinkHref]);
        
        $socialLinkService = app(SocialLinkService::class);
        
        $socialLinkService->update(SocialLink::FACEBOOK_LINK_ID, [
            'name' => 'facebook', 
            'href' => 'https://www.facebook.com/', 
            'sort' => 100]);
    }
        
    /**
    * Тест проверяет удаление социальной ссылки
    * @return void
    */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $socialLinkName = $this->faker->userName;
        
        $socialLinkHref = $this->faker->url();
        
        $socialLinkService = app(SocialLinkService::class);
        
        $socialLinkCreated = $socialLinkService->create(array(
            'site_id' => Site::MAIN_SITE_ID, 
            'name' => $socialLinkName, 
            'href' => $socialLinkHref, 
            'sort' => 100));
        
        $response = $this->post(route('admin.social.link.destroy', $socialLinkCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.social.link.index'));
    }
}