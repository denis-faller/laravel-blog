<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\UserService;
use Blog\Models\Site;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы пользователей
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('users.index'));
        
        $response->assertStatus(200);
    }
    
   /**
     * Тест проверяет отображение страницы создания пользователя
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('users.create'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет создание нового пользователя
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $userName = $this->faker->userName;
        
        $userEmail = $this->faker->unique()->safeEmail;
        
        $response = $this->post(route('users.store'), ['name' => $userName, 'description' => $userName, 'email' => $userEmail, 'password' => Hash::make('password')]);
        
        $userService = app(UserService::class);
        
        $user = $userService->findByEmail($userEmail);
        
        $response->assertLocation(route('users.show', $user->id));
        
        $this->assertDatabaseHas('users', ['name' => $userName]);
        
        $userService->destroy($user->id);
    }
    
    /**
     * Тест проверяет отображение страницы профиля
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('users.show', Auth::user()->id));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных пользователя
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $userName = $this->faker->userName;
        
        $userEmail = $this->faker->unique()->safeEmail;
        
        $response = $this->post(route('users.update', Auth::user()->id), ['_method'=>'PUT', 'id' => Auth::user()->id, 'name' => $userName, 'description' => $userName, 'email' => $userEmail]);
        
        $response->assertLocation(route('users.show', Auth::user()->id));
        
        $this->assertDatabaseHas('users', ['name' => $userName]);
        
        $userService = app(UserService::class);
        
        $userService->update(Auth::user()->id, ['name' => 'Admin', 'description' => 'Admin', 'email' => 'richsiteru@gmail.com']);
    }
    
    /**
     * Тест проверяет удаление пользователя
     * @return void
     */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $userName = $this->faker->userName;
        
        $userEmail = $this->faker->unique()->safeEmail;
        
        $userService = app(UserService::class);
        
        $userCreated = $userService->create(array('site_id' => Site::MAIN_SITE_ID, 
            'name' => $userName, 
            'description' => $userName, 
            'email' => $userEmail, 
            'password' => Hash::make('password')));
        
        $response = $this->post(route('users.destroy', $userCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('users.index'));
    }
}