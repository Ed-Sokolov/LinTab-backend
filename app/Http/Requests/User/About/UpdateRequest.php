<?php

namespace App\Http\Requests\User\About;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'nickname' => 'required|string|unique:users,nickname,' . Auth::id() . '|max:50|min:4',
            'name' => 'nullable|string|max:100',
            'about' => 'nullable|string|max:255'
        ];
    }

    public function messages()
    {
        return [
            'nickname.required' => 'The nickname is required',
            'nickname.string' => 'The nickname must be string',
            'nickname.unique' => 'The nickname already exists',
            'nickname.max' => 'The nickname must be less than 50 characters',
            'nickname.min' => 'The nickname must be more than 4 characters',
            'name.string' => 'The name must be string',
            'name.max' => 'The name must be less than 100 characters',
            'about.string' => 'The about must be string',
            'about.max' => 'The about must be less than 100 characters',
        ];
    }
}
