<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по добавлению нового подписчика
 */
class SubscriberRequest extends FormRequest
{
    /**
     * Правила валидации запроса по добавлению нового подписчика
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:subscribers,email|max:255',
        ];
    }
    
    /**
    * Сообщения для валидации запроса по добавлению нового подписчика
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'email' => 'В поле :attribute должна быть электронная почта.',
            'unique' => 'На почту :input уже оформлена подписка.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
        ];
    }
}
