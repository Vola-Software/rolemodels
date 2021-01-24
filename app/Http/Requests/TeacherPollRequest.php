<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeacherPollRequest extends FormRequest
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
            'school_visit_id' => 'nullable|numeric',
            'did_happen' => 'required',
            'why_failed' => 'required_if:did_happen,-1',
            'useful_rate' => 'required_if:did_happen,1',
            'visit_date' => 'nullable',
            'most_valuable' => 'nullable',
            'invite_rm_again' => 'nullable',
            'why_not_inviting_againt' => 'nullable',
            'next_steps' => 'nullable',
            'improvement_suggestions' => 'nullable',
        ];
    }
}
