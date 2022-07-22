<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class gradesSubjectsRequest extends FormRequest
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
            'subject' => 'required',
            'section' => 'required',
            'grade' => 'required',
            'status' => 'required',
        ];
    }
}
