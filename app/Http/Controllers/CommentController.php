<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        $request->validate([
            "body" => "required"
        ]);

        $post = Post::findOrFail($id);
        $comment = new Comment();
        $comment->body = $request->body;
        $post->comments()->save($comment);

        return redirect("/post/{$post->id}");
    }
}
