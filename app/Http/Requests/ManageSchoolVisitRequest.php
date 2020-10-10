<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ManageSchoolVisitRequest extends FormRequest
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
            'phone_calls_time' => ['required', 'string'],
            'class_stage_id' => ['required', 'numeric'],
            'class_major_id' => ['nullable', 'numeric'],
            'students_details' => ['nullable', 'string'],
            'role_model_profession' => ['required', 'string'],
            'meeting_type' => ['required', 'string'],
            'visit_time' => ['required', 'string'],
            'potential_participants_count' => ['required', 'string'],
            'tech_equipment' => ['nullable', 'string']
        ];
    }

    public function messages()
    {
        return [
            'phone_calls_time' => 'Удобно време за телефонен разговор',
            'class_stage_id' => 'Клас, който желаеш да запишеш и "Ролевия модел" може да посети',
            'class_major_id' => 'Профил на учениците (за гимназиален етап)',
            'students_details' => 'Специфика на учениците',
            'role_model_profession' => '"Ролеви модел" от коя сфера искаш да ви псоети',
            'meeting_type' => 'Как предпочиташ да се включи "Ролевият модел"',
            'visit_time' => 'Удобно време за посещение - ден и час',
            'potential_participants_count' => 'Брой ученици, които биха взели участие',
            'tech_equipment' => 'Училището има ли техническо оборудване'
        ];
    }
}
