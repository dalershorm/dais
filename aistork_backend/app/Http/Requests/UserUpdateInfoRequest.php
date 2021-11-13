<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserUpdateInfoRequest extends FormRequest
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
        if ($this->user_type) {
            return [
                'name' => 'required',
                'b_name' => 'required',
            ];
        }
        else {
            return [
                'name' => 'required',
                'email' => 'required|email',
                'city_id' => 'digits_between:0,100000',
                'gender' => 'required',
            ];
        }
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'b_name.required'         => 'Имя является обязательным',
            'name.required'           => 'Название компании является обязательным',
            'phone.required'          => 'Номер телефона является обязательным',
            'phone.unique'            => 'Пользователь с таким телефоном уже зарегистрирован',
            'email.required'          => 'Email является обязательным',
            'email.email'             => 'Неверный формат email',
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
