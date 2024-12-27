<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CommentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $query = $this->collection;

        return [
            "data" => $query->get()->transform(function ($comment) {
                return [
                    "id" => $comment->id,
                    "body" => $comment->body,
                    "email" => $comment->email,
                ];
            }),
        ];
    }
}
