<?php

namespace Blog\Http\Controllers;

use Illuminate\Http\Request;
use Blog\Services\AboutPageService;
use Blog\Models\AboutPage;
use Blog\Services\StaffService;

/** 
 * Контроллер для вывода страницы о блоге
 */
class AboutPageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
    * Возвращает представление страницы о блоге
    * @param AboutPageService $aboutPageService
    * @param StaffService $staffService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(AboutPageService $aboutPageService, StaffService $staffService)
    {
        $aboutPage = $aboutPageService->find(AboutPage::ABOUT_PAGE_ID);
        $staff = $staffService->getStaff(AboutPage::ABOUT_PAGE_ID);
        
        return view('about', ['title' => 'О нас', 
           'description' => 'Информация о нашем блоге',
            'aboutPage' => $aboutPage,
            'staff' => $staff]);
    }
        
}
