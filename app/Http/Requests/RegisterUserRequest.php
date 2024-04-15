<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username_reg' => 'required|string|max:255',
            'email_reg' => 'required|string|email|max:255|unique:users,email', // Ensure 'email' column is used for uniqueness check
            'password_reg' => 'required|string|min:8|confirmed'
        ];
    }
}
