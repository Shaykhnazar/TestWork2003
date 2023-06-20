<?php

namespace App\Http\Requests;

use App\Http\Requests\Base\FormRequest;
use Illuminate\Validation\Rule;

final class RoleRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'roles.index' => [
                'include' => [
                    'nullable',
                    'string',
                ],
            ],

            'roles.store' => [
                'name' => [
                    'required',
                    'string',
                    Rule::unique('roles')
                ],
                'description' => [
                    'nullable',
                    'string',
                ],
                'permissions' => [
                    'nullable',
                    'array',
                ],
                'permissions.*' => [
                    'required_with:permissions',
                    'integer',
                    Rule::exists('permissions', 'id'),
                ]
            ],

            'roles.update' => [
                'name' => [
                    'required',
                    'string',
                     Rule::unique('roles')->ignore($this->role)
                ],
                'description' => [
                    'nullable',
                    'string',
                ],
                'permissions' => [
                    'nullable',
                    'array',
                ],
                'permissions.*' => [
                    'required_with:permissions',
                    'integer',
                    Rule::exists('permissions', 'id'),
                ]
            ],
        ];

        return $rules[$this->route()->getName()];
    }

    public function authorize(): bool
    {
        return true;
    }
}
