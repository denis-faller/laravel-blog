<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из страницы создания/обновления сотрудника
 */
class StaffRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из страницы создания/обновления сотрудника
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:2500',
            'description' => "required|max:2500",
            'img' => "mimes:jpeg,bmp,png|image|max:2048",
            'facebook' => "max:2500",
            'instagram' => "max:2500",
            'twitter' => "max:2500",
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из страницы создания/обновления сотрудника
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
            'mimes' => 'Файл :attribute должен быть изображением.',
            'image' => 'Файл :attribute должен быть изображением.',
            'img.max' => 'Файл :attribute должен весить не больше 2 МБ.',
        ];
    }
}
