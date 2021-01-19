<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по добавлению новой рассылки
 */
class MailingRequest extends FormRequest
{
    /**
     * Правила валидации запроса по добавлению новой рассылки
     * @return array
     */
    public function rules()
    {
        return [
            'posts' => 'required|max:255',
        ];
    }
    
    /**
    * Сообщения для валидации запроса по добавлению новой рассылки
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
