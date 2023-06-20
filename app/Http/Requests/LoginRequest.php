<?php

namespace App\Http\Requests;

use App\Http\Requests\Base\FormRequest;

final class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function attributes(): array
    {
        return [
            'email' => '"Логин"',
            'password' => '"Пароль"',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }
}
