<?php

namespace App\JsonApi\V1\Posts;

use LaravelJsonApi\Laravel\Http\Requests\ResourceQuery;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class PostCollectionQuery extends ResourceQuery
{

    /**
     * Get the validation rules that apply to the request query parameters.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'fields'      => [
                'nullable',
                'array',
                JsonApiRule::fieldSets(),
            ],
            'filter'      => [
                'nullable',
                'array',
                JsonApiRule::filter(),
            ],
            'filter.search'      => [
                'filled',
                'string',
            ],
            'include'     => [
                'nullable',
                'string',
                JsonApiRule::includePaths(),
            ],
            'page'        => [
                'required',
                'array',
                JsonApiRule::page(),
            ],
            'page.number' => ['filled', 'integer', 'min:1'],
            'page.size'   => ['filled', 'integer', 'min:0', 'max:100'],
            'sort'        => [
                'nullable',
                'string',
                JsonApiRule::sort(),
            ],
            'withCount'   => [
                'nullable',
                'string',
                JsonApiRule::countable(),
            ],
        ];
    }
}
