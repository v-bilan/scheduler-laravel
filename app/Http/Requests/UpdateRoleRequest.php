<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:32|unique:roles,name,',
            'priority' => 'integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => __('Role name is required.'),
            'name.string' => __('Role name must be a string.'),
            'name.max' => __('Role name must not exceed 32 characters.'),
            'name.unique' => __('This role name is already taken.'),
            'priority.integer' => __('Priority must be an integer.'),
            'priority.min' => __('Priority must be at least 0.'),
        ];
    }
}
