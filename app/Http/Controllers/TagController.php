<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TagController extends Controller
{
    //

    public function show(Tag $tag)
    {
        $posts = $tag->posts;
        return Inertia::render('Tags/Show', compact('posts', 'tag'));
    }
}
