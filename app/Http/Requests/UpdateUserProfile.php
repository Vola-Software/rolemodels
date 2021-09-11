<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfile extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],

            'phone' => ['required_if:role_id,9'],
            'school_id' => ['required_if:role_id,9'],
            'subject_ids' => ['required_if:role_id,9'],

            'company_id' => ['required_if:role_id,11'],
            'position' => ['required_if:role_id,11'],
        ];
    }

    public function messages()
    {
        return [
            'first_name' => 'Име',
            'middle_name' => 'Презиме',
            'last_name' => 'Фамилия',
            'role_id' => 'Роля',

            'phone' => 'Телефон',
            'school_id' => 'Училище',
            'subject_ids' => 'Преподавани предмети',
            'company_id' => 'Компания/Организация',
            'position' => 'Длъжност/Дейност',
        ];
    }
}
