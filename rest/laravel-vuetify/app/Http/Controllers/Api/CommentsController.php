<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Comments\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;

class CommentsController
{
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $comment = new Comment();
        $comment->body = $request->validated('body');
        $comment->post_id = $request->validated('post');
        $comment->save();

        return new JsonResponse([
            'data' => new CommentResource($comment),
        ], 201);
    }
}
