<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    //
    public function index(): Response
    {
        return Inertia::render("Posts/Index");
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
