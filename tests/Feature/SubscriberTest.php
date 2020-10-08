<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Blog\Services\SubscriberService;
use Blog\Models\Site;

class SubscriberTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет добавления нового подписчика
     * @return void
     */
    public function testCreate()
    {
        $email = $this->faker->unique()->safeEmail;
        $response = $this->post(route('subscriber.store'), [
            'site_id' => Site::MAIN_SITE_ID, 
            'email' => $email, 
        ]);
        
        $response->assertLocation(route("home.index"));
        
        $subscriberService = app(SubscriberService::class);
        
        $subscriber = $subscriberService->findByEmail($email);
        
        $this->assertDatabaseHas('subscribers', ['id' => $subscriber->id]);
        $subscriberService->destroy($subscriber->id);
    }
}
