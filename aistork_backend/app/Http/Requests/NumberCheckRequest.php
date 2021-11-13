<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class NumberCheckRequest extends FormRequest
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
            'phone'         => 'required|min:9|max:9', // |digits:999999999 // |unique:users|
            // 'confirm_code'  => 'digits_between:1000,9999',
            'reset'         => 'boolean'
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
            'phone.required'                => 'Номер телефона является обязательным',
            // 'phone.unique'                  => 'Пользователь с таким телефоном уже зарегистрирован',
            'phone.max'                     => 'Номер телефона содержит максимум 9 цифр',
            'phone.min'                     => 'Номер телефона содержит минимум 9 цифр',
            'phone.digits'                  => 'Номер телефона должен содержать только число',
            // 'confirm_code.digits_between'   => 'Код подтверждения должен содержать от 1000 до 9999 цифр',
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
