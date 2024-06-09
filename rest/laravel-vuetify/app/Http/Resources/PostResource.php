<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'body'          => $this->body,
            'commentsCount' => $this->comments_count ?? 0,
            'createdAt'     => $this->created_at->toAtomString(),
            'updatedAt'     => $this->updated_at->toAtomString(),
        ];
    }
}
