<?php

namespace App\Http\Requests;

use App\Http\Requests\Base\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    public function rules(): array
    {
        $rules = [
            'posts.index' => [
                'include' => [
                    'nullable',
                    'string',
                ],
            ],

            'posts.store' => [
                'title' => [
                    'required',
                    'string',
                    Rule::unique('posts')
                ],
                'content' => [
                    'required',
                    'string'
                ],
            ],

            'posts.update' => [
                'title' => [
                    'required',
                    'string',
                    Rule::unique('posts')->ignore($this->post)
                ],
                'content' => [
                    'required',
                    'string',
                ],
            ],
        ];

        return $rules[$this->route()->getName()];
    }

    public function authorize(): bool
    {
        return true;
    }
}
