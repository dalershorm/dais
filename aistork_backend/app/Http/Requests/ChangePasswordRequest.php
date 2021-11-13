<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;


class ChangePasswordRequest extends FormRequest
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
            'current_password'=> 'required|min:8',
            'password'=> 'required|min:8|confirmed',
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
            'current_password.required'             => 'Поле текущего пароля является обязательным',
            'current_password.min'                  => 'Текущий пароль должен состоять не менее чем из 8 символов',
            'password.required'                     => 'Поле текущего пароля является обязательным',
            'password.min'                          => 'Текущий пароль должен состоять не менее чем из 8 символов',
            'password.confirmed'                    => 'Пароли не совпадают',
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
