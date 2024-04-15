<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|string|max:255',
            'title' => 'string|max:255',
            'phone' => 'string|max:255',
            'email' => 'required|string|email',
            'about' => 'string',
            'tw' => 'string',
            'fb' => 'string',
            'google' => 'string',
            'linkedin' => 'string',
        ];
    }
}
