<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPropertyRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'type' => 'required|in:0,1,2,3,4',
            'price' => 'required|numeric',
            'area' => 'required|numeric',
            'rooms' => 'required|integer|min:-1',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'description' => 'required|string',
            'building_age' => 'nullable|integer|min:0',
            'bedrooms' => 'nullable|integer|min:1',
            'bathrooms' => 'nullable|integer|min:1',
            'features' => 'nullable|array',
            'features.*' => 'exists:features,id',
            'user_name' => 'required|string|max:20',
            'user_email' => 'required|string|email',
            'user_phone' => 'nullable|string'
        ];
    }
}
