<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class TeachersRequest extends FormRequest
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
            'teacher' => 'required|string',
            'intro' => 'string',
            'subject' => 'required',
            'status' => 'required',
            'mobile' => 'required',
        ];
    }
}
