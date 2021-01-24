<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleModelPollRequest extends FormRequest
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
            'satisfaction_rate' => 'required_if:did_happen,1',
            'most_valuable' => 'nullable',
            'improvement_suggestions' => 'nullable',
            'rolemodel_again' => 'nullable',
            'other_tfb_initiatives' => 'nullable',            
        ];
    }
}
