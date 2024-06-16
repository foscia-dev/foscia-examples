<?php

namespace App\JsonApi\V1\Posts;

use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;

class PostRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required', 'string', 'max:5000'],
        ];
    }

}
