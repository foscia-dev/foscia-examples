<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'body'      => $this->body,
            'createdAt' => $this->created_at->toAtomString(),
            'updatedAt' => $this->updated_at->toAtomString(),
        ];
    }
}
