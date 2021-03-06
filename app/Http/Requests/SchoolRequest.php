<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
            'website' => 'sometimes|url',
            'city_id' => 'required|integer',
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name' => 'Име',
            'website' => 'Сайт',
            'city_id' => 'Населено място',
            'address' => 'Адрес'
        ];
    }
}
