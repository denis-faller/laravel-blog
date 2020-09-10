<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из формы добавления комментария
 */
class CommentAddRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из формы добавления комментария
     * @return array
     */
    public function rules()
    {
        return [
            'post_id' => 'required|integer|max:255',
            'parent_id' => 'max:255',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'website' => 'max:255',
            'message' => 'required|max:255',
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из формы добавления комментария
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'integer' => 'Поле :attribute должно быть целочисленным.',
            'email' => 'В поле :attribute должна быть электронная почта.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
        ];
    }
}
