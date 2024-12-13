<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\DatagridPostResource;
use App\Jobs\CreateThumbnail;
use App\Models\Media;
use App\Models\Post;
use Inertia\Inertia;
use Inertia\Response;
use App\Services\PostService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

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

    public function show(Request $request, $id, $slug = null): Response
    {
        $cachedPost = Redis::get("post:{$id}");
        $userIdOrIp = auth()->check() ? auth()->id() : $request->ip();
        $cachedKey = "post:{$id}:unique_views";
        $isNewVisit = Redis::sadd($cachedKey, $userIdOrIp);
        if($isNewVisit) {
            Redis::expire($cachedKey, 86400);
            Redis::incr("post:{$id}:views");
            Redis::zincrby("posts_ranked_by_views", 1, $id);
        }
        $views = Redis::get("post:{$id}:views");

        if($cachedPost) {
            $post = json_decode($cachedPost);
        } else {
            $post = $this->postService->getPostById($id);
            Redis::setex("post:{$id}", 3600, json_encode($post));
        }
        return Inertia::render("Posts/Show", compact("id", "slug", "post", "views"));
    }

    public function vote($id) {
        $action = request()->input("action");
        $userId = auth()->id();
        $likeKey = "post:{$id}:likes";
        $dislikeKey = "post:{$id}:dislikes";
        if($action==="like") {
            Redis::srem($dislikeKey, $userId);
            Redis::sadd($likeKey, $userId);
            Redis::zincrby("posts_ranked_by_likes", 1, $id);
        } elseif($action ==="dislike") {
            Redis::srem($likeKey, $userId);
            Redis::sadd($dislikeKey, $userId);
            Redis::zincrby("posts_ranked_by_likes", -1, $id);
        } else {
            return response()->json(['error' => 'invalid action']);
        }
        $likesCount = Redis::scard($likeKey);
        $dislikesCount = Redis::scard($dislikeKey);
        return response()->json([
            'likes' => $likesCount,
            'dislikes' => $dislikesCount
        ]);
    }

    public function getVoteStatus($id) {
        $userId = auth()->id();
        if(!$userId) {
            return response()->json(['like'=>false, 'dislike'=>false]);
        }

        $likeKey = "post:{$id}:likes";
        $dislikeKey = "post:{$id}:dislikes";

        $likeCount = Redis::scard($likeKey);
        $dislikeCount = Redis::scard($dislikeKey);
        $likeStatus = Redis::sismember($likeKey, $userId);
        $dislikeStatus = Redis::sismember($dislikeKey, $userId);

        return response()->json([
            'like' => $likeStatus,
            "dislike" => $dislikeStatus,
            "likes"=> $likeCount,
            "dislikes" =>$dislikeCount
        ]);

    }

    public function topPosts() {
        $topPostsByViews = Post::whereIn("id", Redis::zrevrange("posts_ranked_by_views", 0, 9))->get();
        $topPostsByLikes = Post::whereIn("id", Redis::zrevrange("posts_ranked_by_likes", 0, 9))->get();

        return response()->json([
            'topPostsByViews' => $topPostsByViews,
            'topPostsByLikes' => $topPostsByLikes
        ]);
    }

    public function create()
    {
        return Inertia::render("Posts/Create");
    }

    public function store(StorePostRequest $request)
    {
        $tagIds = Collection::make($request->tags)->map(function($item) {
            return abs($item['id']);
        })->flatten()->values()->toArray();
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->description = $request->description;
        $post->content = $request->content;
        $post->user_id = Auth::id();

        if ($request->hasFile("featured_image")) {
            $file = $request->file("featured_image");
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads/media', $fileName, 'public');

            $media = new Media();
            $media->file_name = $fileName;
            $media->file_path = $filePath;
            $media->mime_type = $file->getClientMimeType();
            $media->size = $file->getSize();
            $media->alt_text = $request->title;
            $media->save();

            CreateThumbnail::dispatch($filePath);

            $post->featured_image_id = $media->id;
        }

        try {
            $post->save();
            $post->tags()->sync($tagIds);
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
            Redis::setex("post:{$post->id}", 3600, json_encode($post));
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
