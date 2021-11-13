<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserProfileRequest extends FormRequest
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
        if (auth()->user()->user_type){
            return [
                'name'                  => 'string|nullable',
                // 'phone'                 => 'required|unique:users',
                'email'                 => 'email|nullable',
                'avatar'                => 'string|nullable',
                'year_of_foundation'    => 'nullable',
                'description'           => 'required',
                'schedule'              => 'required',
                'sales_office'          => 'required:json',
                'official_documents'    => 'string|nullable',
                'certificates'          => 'string|nullable',
            ];
        }
        else{
            return [
                'name'      => 'string|nullable',
                'email'     => 'email|nullable',
                'gender'    => 'nullable',
                'city_id'   => 'nullable',
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
            'email.email'           => 'Неверный формат email',
            'description.required'  => 'Описание обязательное поле',
            'sales_office.required' => 'Офис продаж обязательное поле',
            'schedule.required'     => 'График работы обязательное поле',
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
