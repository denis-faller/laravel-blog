<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из страницы создания/обновления комментария
 */
class CommentRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из страницы создания/обновления комментария
     * @return array
     */
    public function rules()
    {
        return [
            'posts' => 'required|max:255',
            'parent_comments' => 'nullable|max:255',
            'message' => 'required|max:255',
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из страницы создания/обновления комментария
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'integer' => 'Поле :attribute должно быть целочисленным.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
        ];
    }
}