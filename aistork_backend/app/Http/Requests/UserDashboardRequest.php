<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserDashboardRequest extends FormRequest
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
        return $this->id ? [
            'name'                  => 'required',
//            'phone'                 => 'required|max:9|unique:users',
            'password'              => 'required|string|confirmed|min:6',
            'avatar'                => 'string|nullable',
            'direction_id'          => 'sometimes',
            'client_code'           => 'sometimes',
        ] : [
            'name'                  => 'required',
            'phone'                 => 'required|max:9|unique:users',
            'password'              => 'required|string|confirmed|min:6',
            'avatar'                => 'string|nullable',
            'direction_id'          => 'sometimes',
            'client_code'           => 'sometimes',
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
            'phone.unique'                  => 'Пользователя с таким номером уже существует',
            'phone.required'                => 'Номер телефона является обязательным',
            'name.required'                 => 'ФИО обязательное поле',
            'password.required'             => 'Пароль является обязательным',
            'password.min'                  => 'Пароль должен содержать минимум 8 символов',
            'password.confirmed'            => 'Пароли не совпадают',
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
