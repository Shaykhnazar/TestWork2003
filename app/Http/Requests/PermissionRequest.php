<?php

namespace App\Http\Requests;

use App\Http\Requests\Base\FormRequest;
use Illuminate\Validation\Rule;

final class PermissionRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'permissions.index' => [
                'include' => [
                    'nullable',
                    'string',
                ],
            ],

            'permissions.store' => [
                'name' => [
                    'required',
                    'string',
                    Rule::unique('permissions')
                ],
                'description' => [
                    'nullable',
                    'string',
                ],
                'roles' => [
                    'nullable',
                    'array',
                ],
                'roles.*' => [
                    'required_with:roles',
                    'integer',
                    Rule::exists('roles', 'id'),
                ]
            ],

            'permissions.update' => [
                'name' => [
                    'required',
                    'string',
                    Rule::unique('permissions')->ignore($this->permission)
                ],
                'description' => [
                    'nullable',
                    'string',
                ],
                'roles' => [
                    'nullable',
                    'array',
                ],
                'roles.*' => [
                    'required_with:roles',
                    'integer',
                    Rule::exists('roles', 'id'),
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
