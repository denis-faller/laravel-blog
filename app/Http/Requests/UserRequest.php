<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из профиля
 */
class UserRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из профиля
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'image' => 'mimes:jpeg,bmp,png|image|max:2048',
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из профиля
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'mimes' => 'Файл :attribute должен быть изображением.',
            'image' => 'Файл :attribute должен быть изображением.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
            'image.max' => 'Файл :attribute должен весить не больше 2 МБ.',
        ];
    }
}
