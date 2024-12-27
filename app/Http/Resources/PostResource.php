<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "publish_date" => jdate($this->created_at)->format("Y-m-d H:i"),
            "author" => $this->author ? new UserResource($this->author) : null  ,
            "comments_no" => $this->comments->count(),
            "comments" => $this->comments ? CommentCollection::collection($this->comments) : null
        ];
    }
}
