<?php

namespace App\Http\Requests\User\Setups\Password;

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
            'old_password' => 'required|string|min:8|max:24',
            'new_password' => 'required|string|min:8|max:24|confirmed',
            'new_password_confirmation' => 'required|string'
        ];
    }
}
