<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\MailingService;
use Blog\Models\Site;
use Blog\Models\Post;
use Blog\Models\Mailing;
use Illuminate\Support\Facades\Hash;

class MailingTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы рассылок
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.mailings.index'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет отображение страницы создания рассылки
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.mailings.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет создание новой рассылки
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $response = $this->post(route('admin.mailings.store'), [
            'posts' => array(Post::AI_REMOVES_POST_ID)]);
        
        $mailingService = app(MailingService::class);
        
        $mailing = $mailingService->findByPostID(Post::AI_REMOVES_POST_ID);
        
        $response->assertLocation(route('admin.mailings.show', $mailing->id));
        
        $this->assertDatabaseHas('mailings', ['post_id' => $mailing->post_id]);
        
        $mailing->destroy($mailing->id);
    }
    
        
    /**
     * Тест проверяет отображение страницы редактирования рассылки
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.mailings.show', Mailing::MAILING_AI_REMOVES_ID));
        
        $response->assertStatus(200);
    }
    
        
    /**
     * Тест проверяет обновления данных рассылки
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $mailingPostID = Post::AI_REMOVES_POST_ID;
        
        $response = $this->post(route('admin.mailings.update', Mailing::MAILING_AI_REMOVES_ID), ['_method'=>'PUT', 
            'posts' => array($mailingPostID)]);
        
        $response->assertLocation(route('admin.mailings.show', Mailing::MAILING_AI_REMOVES_ID));
        
        $this->assertDatabaseHas('mailings', ['post_id' => $mailingPostID]);
    }
    
    /**
    * Тест проверяет удаление рассылки
    * @return void
    */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $mailingService = app(MailingService::class);
        
        $date = \Carbon\Carbon::now();
        $mailingCreated = $mailingService->create(array(
           'site_id' => Site::MAIN_SITE_ID,
           'post_id' => Post::AI_REMOVES_POST_ID,
           'send_time' => $date));
        
        $response = $this->post(route('admin.mailings.destroy', $mailingCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.mailings.index'));
    }
}