<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из страницы обновления сайта
 */
class SiteRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из страницы обновления сайта
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:2500',
            'footer_text' => "required|max:2500",
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из страницы обновления сайта
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
        ];
    }
}
