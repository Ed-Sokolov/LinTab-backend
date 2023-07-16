<?php

namespace App\Http\Requests\User\Avatar;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|file|mimes:jpeg,jpg,png|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'image.required' => 'The image is required',
            'image.file' => 'The image must be file',
            'image.mimes' => 'The extension must be jpeg, jpg or png',
            'image.max' => 'The size must be less than 5MB'
        ];
    }
}
