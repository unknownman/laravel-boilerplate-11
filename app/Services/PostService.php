<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function getAllPost()
    {
        return Post::all();
    }

    public function getPostById($id)
    {
        return Post::with(['tags', "comments"])->find($id);
    }
}
