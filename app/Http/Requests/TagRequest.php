<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из страницы создания/обновления тега
 */
class TagRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из страницы создания/обновления тега
     * @return array
     */
    public function rules()
    {
        $id = intval($this->id);
        
        return [
            'name' => 'required|max:255',
            'url' => "required|unique:tags,url,{$id}|max:255",
            'color' => "required|max:255",
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из страницы создания/обновления тега
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'Тег с урл :input уже есть в системе.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
        ];
    }
}
