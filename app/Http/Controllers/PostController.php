<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function index(): Response
    {
        $posts = Post::all();
        return Inertia::render("Posts/Index", compact("posts"));
    }

    public function show($id, $slug = null): Response
    {
        // compact ('id', 'slug')
        // =
        // [
        //  "id" => $id,
        //  "slug" => $slug
        // ]
        return Inertia::render("Posts/Show", compact("id", "slug"));
    }
}
