<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Services\PostService;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    //
    public function index(): Response
    {
        $posts = $this->postService->getAllPost();
        return Inertia::render("Posts/Index", compact("posts"));
    }

    public function show($id, $slug = null): Response
    {
        $post = $this->postService->getPostById($id);
        return Inertia::render("Posts/Show", compact("id", "slug", "post"));
    }
}
