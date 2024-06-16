<?php

namespace App\JsonApi\V1\Comments;

use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class CommentRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'max:1000'],
            'post' => ['required', JsonApiRule::toOne()],
        ];
    }

}
