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
            'nickname' => 'required|string|unique:users,nickname,' . Auth::id() . '|max:255',
            'name' => 'string|max:255',
            'about' => 'string|max:255'
        ];
    }
}
