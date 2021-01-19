<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\SubscriberService;
use Blog\Models\Site;
use Blog\Models\Subscriber;
use Illuminate\Support\Facades\Hash;

class SubscriberTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы подписчиков
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.subscribers.index'));
        
        $response->assertStatus(200);
    }
    
        
    /**
     * Тест проверяет отображение страницы создания подписчика
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.subscribers.create'));
        
        $response->assertStatus(200);
    }
    
        
    /**
     * Тест проверяет создание нового подписчика
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $subscriberEmail = $this->faker->unique()->email;
        
        $response = $this->post(route('admin.subscribers.store'), [
            'email' => $subscriberEmail]);
        
        $subscriberService = app(SubscriberService::class);
        
        $subscriber = $subscriberService->findByEmail($subscriberEmail);
        
        $response->assertLocation(route('admin.subscribers.show', $subscriber->id));
        
        $this->assertDatabaseHas('subscribers', ['email' => $subscriber->email]);
        
        $subscriber->destroy($subscriber->id);
    }
    
    /**
     * Тест проверяет отображение страницы редактирования подписчика
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.subscribers.show', Subscriber::RICH_SITE_MAIL_ID));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных подписчика
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $subscriberEmail = $this->faker->unique()->email;
        
        $response = $this->post(route('admin.subscribers.update', Subscriber::RICH_SITE_MAIL_ID), ['_method'=>'PUT', 
            'email' => $subscriberEmail]);
        
        $response->assertLocation(route('admin.subscribers.show', Subscriber::RICH_SITE_MAIL_ID));
        
        $this->assertDatabaseHas('subscribers', ['email' => $subscriberEmail]);
        
        $subscriberService = app(SubscriberService::class);
        
        $subscriberService->update(Subscriber::RICH_SITE_MAIL_ID, [
            'email' => "richsiteru@gmail.com"]);
    }
    
           
    /**
    * Тест проверяет удаление подписчика
    * @return void
    */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $subscriberEmail = $this->faker->unique()->email;
        
        $subscriberService = app(SubscriberService::class);
        
        $subscriberCreated = $subscriberService->create(array(
            'site_id' => Site::MAIN_SITE_ID, 
            'email' => $subscriberEmail));
        
        $response = $this->post(route('admin.subscribers.destroy', $subscriberCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.subscribers.index'));
    }
}