<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Posts\IndexPostRequest;
use App\Http\Requests\Posts\StorePostRequest;
use App\Http\Resources\CommentResource;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostsController
{
    public function index(IndexPostRequest $request): JsonResponse
    {
        $query = Post::query()
            ->when($request->validated('search'))
            ->where('title', 'LIKE', '%' . $request->validated('search') . '%')
            ->latest()
            ->paginate($request->validated('size'));

        return new JsonResponse([
            'data' => PostResource::collection($query->items()),
            'meta' => [
                'page' => [
                    'total' => $query->total(),
                ],
            ],
        ]);
    }

    public function store(StorePostRequest $request): JsonResponse
    {
        $post = Post::query()->create($request->validated());

        return new JsonResponse([
            'data' => new PostResource($post),
        ], 201);
    }

    public function show(Post $post): JsonResponse
    {
        return new JsonResponse([
            'data' => new PostResource($post),
        ]);
    }

    public function showComments(Post $post): JsonResponse
    {
        $post->loadMissing('comments');

        return new JsonResponse([
            'data' => CommentResource::collection($post->comments),
        ]);
    }

    public function destroy(Post $post): JsonResponse
    {
        $post->delete();

        return new JsonResponse('', 204);
    }
}
