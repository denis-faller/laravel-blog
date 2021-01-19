<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\ContactPageService;
use Blog\Models\Site;
use Blog\Models\ContactPage;
use Illuminate\Support\Facades\Hash;

class ContactPageTest extends TestCase
{
    use WithFaker;
    /**
     * Тест проверяет отображение страницы редактирования страницы контактов
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.contactpage.show', ContactPage::CONTACT_PAGE_ID));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных страницы контактов
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $titleText = $this->faker->userName;
        $address = $this->faker->address;
        $phone = $this->faker->phoneNumber;
        $email = $this->faker->email;
        
        $response = $this->post(route('admin.contactpage.update', ContactPage::CONTACT_PAGE_ID), ['_method'=>'PUT', 
            'title_text' => $titleText, 
            'address' => $address,
            'phone' => $phone,
            'email' => $email]);
        
        $response->assertLocation(route('admin.contactpage.show', ContactPage::CONTACT_PAGE_ID));
        
        $this->assertDatabaseHas('contact_page', ['title_text' => $titleText]);
        
        $contactPageService = app(ContactPageService::class);
        
        $contactPageService->update(ContactPage::CONTACT_PAGE_ID, [
            'title_text' => '<h1 class="">Contact Us</h1>
              <p class="lead mb-4 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, adipisci?</p>', 
            'address' => '203 Fake St. Mountain View, San Francisco, California, USA',
            'phone' => '+1 232 3235 324',
            'email' => 'youremail@domain.com',
            ]);
    }
}