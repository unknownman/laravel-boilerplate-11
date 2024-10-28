<?php

namespace App\Http\Controllers;

use App\Http\Resources\DatagridCommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

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

    public function datagrid(Request $request)
    {
        $comments = Comment::with("commentable");
        if ($request->filter)
            $comments = $comments->whereLike('body', '%' . $request->filter . '%');

        if ($request->trash)
            $comments = $comments->onlyTrashed();

        $comments = $comments->paginate(10);

        $data = DatagridCommentResource::collection($comments);
        return Inertia::render('Comments/Datagrid', compact('data'));
    }

    public function status(Request $request)
    {
        $comment = Comment::find($request->id);
        if ($comment->status == 'unapproved')
            $comment->status = 'approved';
        else
            $comment->status = 'unapproved';
        $comment->save();
    }

    public function trash(Comment $comment)
    {
        if ($comment->trashed())
            $comment->restore();
        else
            $comment->delete();

        redirect()->back();
    }

    public function delete(Comment $comment)
    {
        $comment->forceDelete();
        redirect()->back();
    }
}
