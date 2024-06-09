<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class IndexPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => ['filled', 'string'],
            'size'   => ['required', 'integer', 'min:0', 'max:100'],
            'page'   => ['required', 'integer', 'min:1'],
        ];
    }
}
