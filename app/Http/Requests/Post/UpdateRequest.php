<?php

namespace App\Http\Requests\Post;

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
            'title' => 'string|min:4|max:255',
            'content' => 'string|min:100|max:60000',
            'image'=>'nullable|file|mimes:jpeg,jpg,png|max:5000'
        ];
    }

    public function messages()
    {
        return [
//            'title.required' => 'The title is required',
            'title.string' => 'The title must be string',
            'title.min' => 'The title must be more than 4 characters',
            'title.max' => 'The title must be less than 255 characters',
//            'content.required' => 'The content is required',
            'content.string' => 'The content must be string',
            'content.min' => 'The content must be more than 100 characters',
            'content.max' => 'The content must be less than 60000 characters',
            'image.file' => 'The image must be file',
            'image.mimes' => 'The extension must be jpeg, jpg or png',
            'image.max' => 'The size must be less than 5MB',
        ];
    }
}
