<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\StaffService;
use Blog\Models\AboutPage;
use Blog\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffTest extends TestCase
{
    use WithFaker;
    
    /**
     * Тест проверяет отображение страницы сотрудников
     * @return void
     */
    public function testIndex()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.staff.index'));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет отображение страницы создания сотрудника
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.staff.create'));
        
        $response->assertStatus(200);
    }
     
    /**
     * Тест проверяет создание нового сотрудника
     * @return void
     */
    public function testStore()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $staffName = $this->faker->userName;
        
        $response = $this->post(route('admin.staff.store'), [
            'about_page_id' => AboutPage::ABOUT_PAGE_ID,
            'name' => $staffName, 
            'description' => $staffName]);
        
        $staffService = app(StaffService::class);
        
        $staff = $staffService->findByName($staffName);
        
        $response->assertLocation(route('admin.staff.show', $staff->id));
        
        $this->assertDatabaseHas('staff', ['name' => $staff->name]);
        
        $staffService->destroy($staff->id);
    }
            
    /**
     * Тест проверяет отображение страницы редактирования сотрудника
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.staff.show', Staff::EMPLOYEE_KATE_HAMPTON));
        
        $response->assertStatus(200);
    }
        
    /**
     * Тест проверяет обновления данных сотрудника
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $staffName = $this->faker->userName;
        
        $response = $this->post(route('admin.staff.update', Staff::EMPLOYEE_KATE_HAMPTON), [
            '_method'=>'PUT', 
            'about_page_id' => AboutPage::ABOUT_PAGE_ID,
            'name' => $staffName, 
            'description' => $staffName]);
        
        $response->assertLocation(route('admin.staff.show', Staff::EMPLOYEE_KATE_HAMPTON));
        
        $this->assertDatabaseHas('staff', ['name' => $staffName]);
        
        $staffService = app(StaffService::class);
        
        $staffService->update(Staff::EMPLOYEE_KATE_HAMPTON, [
            'name' => "Kate Hampton", 
            'description' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Earum neque nobis eos quam necessitatibus rerum aliquid est tempore, cupiditate iure at voluptatum dolore, voluptates. Debitis accusamus, beatae ipsam excepturi mollitia."
        ]);
    }
    
          
    /**
    * Тест проверяет удаление сотрудника
    * @return void
    */
    public function testDestroy()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $staffName = $this->faker->userName;
        
        $staffService = app(StaffService::class);
        
        $staffCreated = $staffService->create(array(
            'about_page_id' => AboutPage::ABOUT_PAGE_ID,
            'name' => $staffName, 
            'description' => $staffName,
            'img' => ""));
        
        $response = $this->post(route('admin.staff.destroy', $staffCreated->id), ['_method'=>'DELETE']);
        
        $response->assertLocation(route('admin.staff.index'));
    }
}