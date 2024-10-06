<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\DatagridPostResource;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function create()
    {
        return Inertia::render("Posts/Create");
    }

    public function store(StorePostRequest $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->user_id = Auth::id();

        try {
            $post->save();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'مشکل در ذخیره پست'
            ]);
        }

        return redirect("/posts")->with("success", "پست با موفقیت ذخیره شد");
    }

    public function edit(Post $post)
    {
        return Inertia::render("Posts/Edit", compact("post"));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->slug = $request->slug;
        try {
            $post->save();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'error' => 'مشکل در ویرایش پست'
            ]);
        }
    }

    public function datagrid(Request $request)
    {
        // $data
        $posts = Post::with("user")->withCount('postComments');
        if ($request->filter)
            $posts = $posts->whereLike('title', '%' . $request->filter . '%');

        $posts = $posts->paginate(10);

        $data = DatagridPostResource::collection($posts);
        return Inertia::render("Posts/Datagrid", compact("data"));
    }
}
