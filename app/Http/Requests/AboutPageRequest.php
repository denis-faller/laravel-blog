<?php

namespace Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/** 
 * Класс запроса по отправке данных из страницы создания/обновления страницы о нас
 */
class AboutPageRequest extends FormRequest
{
    /**
     * Правила валидации запроса отправки данных из страницы создания/обновления страницы о нас
     * @return array
     */
    public function rules()
    {
        return [
            'title_text' => 'required|max:2500',
            'title_img' => "mimes:jpeg,bmp,png|image|max:2048",
            'after_title_text' => "required|max:2500",
            'after_title_img' => "mimes:jpeg,bmp,png|image|max:2048",
            'team_title_text' => "required|max:2500",
            'after_team_text' => "required|max:2500",
            'after_team_img' => "mimes:jpeg,bmp,png|image|max:2048",
        ];
    }
    
    /**
    * Сообщения для валидации запроса отправки данных из страницы создания/обновления страницы о нас
    * @return array
    */
    public function messages()
    {
        return [
            'required' => 'Поле :attribute должно быть заполнено.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
            'mimes' => 'Файл :attribute должен быть изображением.',
            'image' => 'Файл :attribute должен быть изображением.',
            'title_img.max' => 'Файл :attribute должен весить не больше 2 МБ.',
            'after_title_img.max' => 'Файл :attribute должен весить не больше 2 МБ.',
            'after_team_img.max' => 'Файл :attribute должен весить не больше 2 МБ.',
        ];
    }
}
