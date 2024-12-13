<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DatagridPostResource extends JsonResource
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
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "author" => $this->user->name,
            "comments_no" => $this->post_comments_count
        ];
    }
}
