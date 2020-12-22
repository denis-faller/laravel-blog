<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Blog\Services\AboutPageService;
use Blog\Models\Site;
use Blog\Models\AboutPage;
use Illuminate\Support\Facades\Hash;

class AboutPageTest extends TestCase
{
    use WithFaker;
    /**
     * Тест проверяет отображение страницы редактирования страницы о нас
     * @return void
     */
    public function testShow()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        $response = $this->get(route('admin.aboutpage.show', AboutPage::ABOUT_PAGE_ID));
        
        $response->assertStatus(200);
    }
    
    /**
     * Тест проверяет обновления данных страницы о нас
     * @return void
     */
    public function testUpdate()
    {
        $response = $this->post("/login", [
            'email' => 'richsiteru@gmail.com', 
            'password' => 'password', 
        ]);
        
        $titleText = $this->faker->userName;
        $afterTitleText = $this->faker->userName;
        $teamTitleText = $this->faker->userName;
        $afterTeamText = $this->faker->userName;
        
        $response = $this->post(route('admin.aboutpage.update', AboutPage::ABOUT_PAGE_ID), ['_method'=>'PUT', 
            'title_text' => $titleText, 
            'after_title_text' => $afterTitleText, 
            'team_title_text' => $teamTitleText,
            'after_team_text' => $afterTeamText]);
        
        $response->assertLocation(route('admin.aboutpage.show', AboutPage::ABOUT_PAGE_ID));
        
        $this->assertDatabaseHas('about_page', ['title_text' => $titleText]);
        
        $aboutPageService = app(AboutPageService::class);
        
        $aboutPageService->update(AboutPage::ABOUT_PAGE_ID, [
            'title_text' => '<h1 class="">About Us</h1>
<p class="lead mb-4 text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem, adipisci?</p>', 
            'after_title_text' => '<h2>We Love To Explore</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea voluptate odit corrupti vitae cupiditate explicabo, soluta quibusdam necessitatibus, provident reprehenderit, dolorem saepe non eligendi possimus autem repellendus nesciunt, est deleniti libero recusandae officiis. Voluptatibus quisquam voluptatum expedita recusandae architecto quibusdam.</p>
<ul class="ul-check list-unstyled success">
<li>Onsectetur adipisicing elit</li>
<li>Dolorem saepe non eligendi possimus</li>
<li>Voluptate odit corrupti vitae</li>
</ul>', 
            'team_title_text' => '<h2>Meet The Team</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus commodi blanditiis, soluta magnam atque laborum ex qui recusandae</p>',
            'after_team_text' => '<h2>Learn From Us</h2>
<p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea voluptate odit corrupti vitae cupiditate explicabo, soluta quibusdam necessitatibus, provident reprehenderit, dolorem saepe non eligendi possimus autem repellendus nesciunt, est deleniti libero recusandae officiis. Voluptatibus quisquam voluptatum expedita recusandae architecto quibusdam.</p>'
            ]);
    }
}