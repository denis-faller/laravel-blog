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
        $id = intval($this->id);
        
        if($this->url() == route('users.store')){
            $passwordRule = "required|min:6|max:255";
        }
        elseif($this->url() == route('users.update', $id)){
            $passwordRule = "nullable|min:6|max:255";
        }
        
        return [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'email' => "required|email|unique:users,email,{$id}|max:255",
            'password' => $passwordRule,    
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
            'unique' => 'Пользователь с почтой :input уже зарегистрирован.',
            'mimes' => 'Файл :attribute должен быть изображением.',
            'image' => 'Файл :attribute должен быть изображением.',
            'min' => 'Поле :attribute должно быть не меньше 6 символов.',
            'max' => 'Поле :attribute должно быть не больше 255 символов.',
            'image.max' => 'Файл :attribute должен весить не больше 2 МБ.',
        ];
    }
}
