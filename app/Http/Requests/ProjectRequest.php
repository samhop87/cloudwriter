<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class ProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'project_name' => 'required|string',
            'themeChoice' => 'required|array',
            'themeChoice.*.name' => 'required|string',
            'shapeChoice' => 'required|integer',
            'pov.name' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'project_name.required' => 'Please enter a project name.',
            'themeChoice.*.name.required' => 'Please select a theme.',
            'themeChoice.required' => 'Please select a theme.',
            'shapeChoice.required' => 'Please select a story shape.',
            'pov.name.required' => 'Please select a point of view.',
        ];
    }
}
