<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "data" => $this->collection->transform(function($post) {
                return [
                    "id" => $post->id,
                    "title" => $post->title,
                    "description" => $post->description,
                    "publish_date" => jdate($post->created_at->timestamp)->format("Y-m-d H:i"),
                    "author" => $post->user ? new UserResource($post->user) : null
                ];
            }),
            'meta' => [
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
                'total_items' => $this->total()
            ],
            'links' => [
                "self" => $this->path(),
                "next" => $this->nextPageUrl(),
                "prev" => $this->previousPageUrl(),
            ]
        ];
    }
}
