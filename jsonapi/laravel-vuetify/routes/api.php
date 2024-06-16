<?php

use LaravelJsonApi\Laravel\Facades\JsonApiRoute;
use LaravelJsonApi\Laravel\Http\Controllers\JsonApiController;
use LaravelJsonApi\Laravel\Routing\Relationships;
use LaravelJsonApi\Laravel\Routing\ResourceRegistrar;

JsonApiRoute::server('v1')
    ->prefix('v1')
    ->resources(function (ResourceRegistrar $server) {
        $server->resource('posts', JsonApiController::class)
            ->except('update')
            ->relationships(function (Relationships $relationships) {
                $relationships->hasMany('comments')->readOnly();
            });
        $server->resource('comments', JsonApiController::class)
            ->only('store');
    });
