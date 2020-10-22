<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Blog\Services\UserService;

class RegisterTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет регистрацию пользователя
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/register", [
            'name' => $this->faker->userName, 
            'email' => $this->faker->unique()->safeEmail, 
            'password' => 'password', 
            'password_confirmation' => 'password', 
        ]);
        
        $response->assertLocation(route("home.index"));
        
        $this->assertDatabaseHas('users', ['id' => Auth::user()->id]);
        
        $userService = app(UserService::class);
        $userService->destroy(Auth::user()->id);
    }
}
