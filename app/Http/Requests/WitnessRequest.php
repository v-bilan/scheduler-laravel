<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WitnessRequest extends FormRequest
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
            'full_name' => 'required|string|max:64',
            'active' => 'integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Full name is required.',
            'name.string' => 'Full name must be a string.',
            'name.max' => 'Full name may not be greater than 64 characters.',
            'active.integer' => 'Active must be an integer.',
        ];
    }
}
