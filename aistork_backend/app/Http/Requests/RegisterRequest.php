<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'direction_id' => 'sometimes',
            'phone' => 'required|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'           => 'Название компании является обязательным',
            'phone.required'          => 'Номер телефона является обязательным',
            'phone.unique'            => 'Пользователь с таким телефоном уже зарегистрирован',
            // 'email.required'          => 'Email является обязательным',
            // 'email.email'             => 'Неверный формат email',
            'password.required'       => 'Пароль является обязательным',
            'password.min'            => 'Пароль должен содержать минимум 8 символов',
            'password.confirmed'      => 'Пароли не совпадают',
        ];
    }
    
    /**
    * [failedValidation [Overriding the event validator for custom error response]]
    * @param  Validator $validator [description]
    *
    * @return [object][object of various validation errors]
    */
    public function failedValidation(Validator $validator) { 
       throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }
}
