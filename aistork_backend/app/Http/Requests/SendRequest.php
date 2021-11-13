<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class SendRequest extends FormRequest
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
            'status_id' => 'required',
            'boxes' => 'required',
            'comment' => 'nullable',
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
            'name.required'  => 'Название обязательное поле',
            'name.status_id'  => 'Статус обязательное поле',
            'boxes.required'  => 'Заказы обязательное поле',
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
