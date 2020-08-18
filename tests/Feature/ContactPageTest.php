<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Blog\Models\ContactPage;

class ContactPageTest extends TestCase
{
    use WithFaker;
    /**
     * Тест проверяет отображение страницы контактов
     * @return void
     */
    public function testView()
    {
        $response = $this->get(route('contact.index'));
        
        $response->assertStatus(200);
        
        $this->assertDatabaseHas('contact_page', ['id' => ContactPage::CONTACT_PAGE_ID]);
    }
    
    /**
     * Тест проверяет отправку письма с формы контактов
     * @return void
     */
    public function testSend()
    {
        $response = $this->post(route('contact.send'), [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'subject' => $this->faker->company(),
            'message' => $this->faker->company(),
        ]);
        
        $response->assertLocation(route("contact.index"));
    }
}
