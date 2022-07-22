<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class GradesSectionsRequest extends FormRequest
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
            'name_ar' => 'required|unique:grades_sections,Name->ar',
            'name_en' => 'required|unique:grades_sections,Name->en',
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }
}
