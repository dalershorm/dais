<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PaymentRequest extends FormRequest
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
            'user_id'       => 'required',
            'weight'        => 'required',
            'places'        => 'required',
            'total'         => 'required',
            'cost'          => 'required',
            'cost_china'    => 'required',
            'orders'        => 'required'
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
            'user_id.required'          => 'Клиент обязательное поле',
            'weight.required'           => 'Общий вес обязательное поле',
            'places.required'           => 'Место обязательное поле',
            'total.required'            => 'Клиент обязательное поле',
            'cost.required'             => 'Общая цена обязательное поле',
            'cost_china.required'       => 'Клиент обязательное поле',
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
