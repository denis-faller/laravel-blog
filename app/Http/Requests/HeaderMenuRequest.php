<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из страницы создания/обновления пункта верхнего меню
 */
class HeaderMenuRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из страницы создания/обновления пункта верхнего меню
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'url' => "required|max:255",
            'sort' => "required|integer",
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из страницы создания/обновления пункта верхнего меню
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'integer' => ':attribute должно быть целочисленым.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
        ];
    }
}
