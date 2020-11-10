<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из страницы создания/обновления поста
 */
class PostRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из страницы создания/обновления поста
     * @return array
     */
    public function rules()
    {
        $id = intval($this->id);
        
        return [
            'categories' => 'required|max:255',
            'name' => 'required|max:255',
            'url' => "required|unique:posts,url,{$id}|max:255",
            'text' => "required|max:2048",
            'preview' => 'mimes:jpeg,bmp,png|image|max:2048',
            'image' => 'mimes:jpeg,bmp,png|image|max:2048',          
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из страницы создания/обновления поста
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'Пост с урл :input уже есть в системе.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
            'mimes' => 'Файл :attribute должен быть изображением.',
            'image' => 'Файл :attribute должен быть изображением.',
            'preview.max' => 'Файл :attribute должен весить не больше 2 МБ.',
            'image.max' => 'Файл :attribute должен весить не больше 2 МБ.',
        ];
    }
}
