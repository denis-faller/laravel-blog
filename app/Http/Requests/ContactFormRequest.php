<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из формы контактов
 */
class ContactFormRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из формы контактов
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:255',
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из формы контактов
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'email' => 'В поле :attribute должна быть электронная почта.',
        ];
    }
}
