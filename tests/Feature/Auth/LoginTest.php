<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class LoginTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет авторизацию админа
     * @return void
     */
    public function testLogin()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $response->assertLocation(route("home.index"));
        
        $this->assertDatabaseHas('users', ['id' => Auth::user()->id]);
    }
}
