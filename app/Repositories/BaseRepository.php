<?php
namespace Blog\Repositories;

use Illuminate\Database\Eloquent\Model;

/** 
 * Абстрактный класс репозитория
 */
abstract class BaseRepository
{
    /**
    * Свойство, хранящее поле для сортировки
    * @var string
    */
    protected $sortBy = 'created_at';
    
    /**
    * Свойство, хранящее порядок сортировки
    * @var string
    */
    protected $sortOrder = 'asc';
    
    /**
    * Свойство, хранящее поле для фильтрации
    * @var string
    */
    protected $filterBy = 'site_id';
    
    /**
    * Свойство, хранящее значения для фильтрации
    * @var mixed
    */
    protected $filterValue = 1;
    
    /**
    * Возвращает все элементы модели
    * @return Blog\Model
    */  
    public function all()
    {
        return $this->model
             ->where($this->filterBy, $this->filterValue)   
             ->orderBy($this->sortBy, $this->sortOrder)
             ->get();
    }

    /**
    * Возвращает элементы модели постранично
    * @param int $paginate
    * @return Blog\Model
    */  
    public function paginated($paginate)
    {
        return $this->model
            ->where($this->filterBy, $this->filterValue)       
            ->orderBy($this->sortBy, $this->sortOrder)
            ->paginate($paginate);
    }

    /**
    * Создает элемент модели
    * @param array $input 
    * @return Blog\Model
    */  
    public function create($input)
    {
        $model = $this->model;
        $model->fill($input);
        $model->save();

        return $model;
    }

    /**
    * Находит элемент модели
    * @param int $id 
    * @return Blog\Model
    */  
    public function find($id)
    {
        return $this->model->where('id', $id)->first();
    }
    
    /**
    * Обновляет элемент модели
    * @param int $id 
    * @param array $input 
    * @return Blog\Model
    */ 
    public function update($id, array $input)
    {
        $model = $this->find($id);
        $model->fill($input);
        $model->save();

        return $model;
    }

    /**
    * Удаляет элемент модели
    * @param int $id 
    * @return Blog\Model
    */ 
    public function destroy($id)
    {
        return $this->find($id)->delete();
    }
}