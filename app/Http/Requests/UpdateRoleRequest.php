<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends RoleRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function rules(): array
    {;
        return [
            'name' => 'required|string|max:32|unique:roles,name,' . $this->route('role')->id,
            'priority' => 'integer|min:0',
        ];
    }
}
