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
        return [
            "data" => $this->collection->transform(function($coment) {
                return [
                    "id" => $coment->id,
                    "body" => $coment->body,
                    "email" => $coment->email,
                    "date" => jdate($coment->created_at)->format("Y-m-d H:i")
                ];
            })
        ];
    }
}
