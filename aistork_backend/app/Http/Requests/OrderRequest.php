<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class OrderRequest extends FormRequest
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
            'user_id' => 'required',
            'track_code' => 'required',
            'weight' => 'required',
//            'comment' => 'required',
            'cost' => 'required',
//            'cost_china' => 'required',
            'shipping_id' => 'required',
            'direction_id' => 'required',
            'boxes' => 'required',
            'status_id' => 'required',
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
            'user_id.required'  => 'Код клиента обязательное поле',
            'track_code.required'  => 'Трек код обязательное поле',
            'weight.required'  => 'Вес обязательное поле',
            'comment.required'  => 'Комментарии обязательное поле',
            'cost.required'  => 'Стоимость доставки обязательное поле',
            'cost_china.required'  => 'Стоимость доставки в Китае обязательное поле',
            'shipping_id.required'  => 'От куда куда обязательное поле',
            'direction_id.required'  => 'Тип доставки обязательное поле',
            'boxes.required'  => 'Место обязательное поле',
            'status_id.required'  => 'Статус обязательное поле',
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
