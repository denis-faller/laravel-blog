<?php

namespace Blog\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Blog\Services\StaffService;
use Blog\Http\Controllers\Controller;
use Blog\Models\Staff;
use Blog\Models\AboutPage;
use Blog\Http\Requests\StaffRequest;

/** 
 * Контроллер для работы с сотрудниками
 */
class StaffController extends Controller
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
    * Возвращает представление страницы сотрудников
    * @param Request $request
    * @param StaffService $staffService
    * @return Illuminate\Support\Facades\View
    */  
    public function index(Request $request, StaffService $staffService)
    {
        $this->authorize('index', Staff::class);
        
        $paginateStaff = $staffService->paginated(9);
        
        if($request->page < 0 || $request->page > $paginateStaff->lastPage()){
            abort(404);
        }
        $currentPage = $paginateStaff->currentPage();
        
        $staff = $paginateStaff->all();
        
        $title = 'Сотрудники блога - страница '.$currentPage;
        $description = 'Сотрудники блога - страница '.$currentPage;
        
        return view('admin.staff.index', ['title' => $title, 
           'description' => $description,
           'staff' => $staff,
           'paginateStaff' => $paginateStaff]);
    }
        
    /**
    * Возвращает представление страницы создания нового сотрудника
    * @param StaffService $staffService
    * @return Illuminate\Support\Facades\View
    */  
    public function create(StaffService $staffService)
    {
        $this->authorize('create', Staff::class);

        $title = 'Создание нового сотрудника блога';
        $description = 'Создание нового сотрудника блога';
        return view('admin.staff.create', [
           'title' => $title, 
           'description' => $description]);
    }
    
    /**
    * Создает нового сотрудника
    * @param StaffRequest $request
    * @param StaffService $staffService
    * @return Illuminate\Routing\Redirector
    */  
    public function store(StaffRequest $request, StaffService $staffService)
    {
        $this->authorize('store', Staff::class);
        
        if(isset($request->img)){
            $imgName = $request->img->hashName();

            $request->img->move(public_path('assets/images'), $imgName);

            $imgPath = '/assets/images/'.$imgName;
        }
        else{
            $imgPath = "";
        }
        
        $staffCreated = $staffService->create(array(
            'about_page_id' => AboutPage::ABOUT_PAGE_ID,
            'name' => $request->name, 
            'description' => $request->description, 
            'img' => $imgPath,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter));
     
        if(isset($staffCreated->id)){
            return redirect(route('admin.staff.show', $staffCreated->id));
        }
    }
    
    /**
    * Возвращает представление страницы сотрудника
    * @param Staff $staff
    * @return Illuminate\Support\Facades\View
    */
    public function show(Staff $staff)
    {
        $this->authorize('show', Staff::class);
        
        $title = 'Страница сотрудника '.$staff->name;
        $description = 'Страница сотрудника '.$staff->name;
        
        return view('admin.staff.show', ['title' => $title, 
           'description' => $description,
           'staff' => $staff]);
    }
    
        
    /**
    * Обновляет информацию о сотруднике
    * @param Staff $staff
    * @param StaffRequest $request
    * @param StaffService $staffService
    * @return Illuminate\Routing\Redirector
    */  
    public function update(Staff $staff, StaffRequest $request, StaffService $staffService)
    {
        $this->authorize('update', Staff::class);
        
        if(isset($request->img)){
            $imgName = $request->img->hashName();

            $request->img->move(public_path('assets/images'), $imgName);

            $imgPath = '/assets/images/'.$imgName;
        }
        else{
            $imgPath = $staff->img;
        }
        
        $staffUpdated = $staffService->update($staff->id, array(
            'about_page_id' => AboutPage::ABOUT_PAGE_ID,
            'name' => $request->name, 
            'description' => $request->description, 
            'img' => $imgPath,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'twitter' => $request->twitter));
        
        if(isset($staffUpdated->id)){
            return redirect(route('admin.staff.show', $staff->id));
        }
    }
    
       
    /**
    * Удаляет сотрудника
    * @param Staff $staff
    * @param StaffService $staffService
    * @return Illuminate\Routing\Redirector
    */  
    public function destroy(Staff $staff, StaffService $staffService)
    {
        $this->authorize('destroy', Staff::class);
        
        $isDelete = $staffService->destroy($staff->id);
        
        if($isDelete){
            return redirect(route('admin.staff.index'));
        }
    }
}
