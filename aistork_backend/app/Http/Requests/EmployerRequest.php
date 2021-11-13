<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EmployerRequest extends FormRequest
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
        return $this->id ?
        [
            'name' => 'required',
            'roles' => 'required',
            'is_active' => 'required',
            'employer' => 'boolean',
            'password' => 'required|min:8',
            'new_balance' => 'required',
            'description'=> 'nullable'
        ] : [
            'name' => 'required',
            'phone' => 'required|unique:users',
            'roles' => 'required',
            'is_active' => 'required',
            'password' => 'required|min:8',
            'employer' => 'boolean',
            'balance' => 'required',
            'description'=> 'nullable'
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
            'name.required'           => 'ФИО является обязательным',
            'phone.required'          => 'Номер телефона является обязательным',
            'phone.unique'            => 'Пользователь с таким телефоном уже зарегистрирован',
            'password.required'       => 'Пароль является обязательным',
            'password.min'            => 'Пароль должен содержать минимум 8 символов',
            'is_active.required'      => 'Статус является обязательным',
            'roles.required'          => 'Роли является обязательным',
            'balance.required'        => 'Баланс является обязательным',
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
