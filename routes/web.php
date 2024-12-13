<?php

use App\Http\Controllers\AuthMobileLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MessengerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get("/greeting", function () {
    return Inertia::render("HelloWorld");
});

Route::get("/posts", [PostController::class, "index"]);
Route::post("/post/{id}/vote", [PostController::class, "vote"])->middleware("auth");
Route::get("/post/{id}/vote", [PostController::class, "getVoteStatus"])->middleware("auth");
Route::get("/posts/top-posts", [PostController::class, "topPosts"]);
Route::get("/post/{id}/{slug?}", [PostController::class, "show"]);
Route::post("/post/{id}/comment", [CommentController::class, "store"]);

// Tag Route
Route::get("/tags/datagrid", [TagController::class, "datagrid"])
    ->middleware("auth")
    ->name("tags.datagrid");
Route::get("/tags/edit/{tag:id}", [TagController::class, "edit"])
    ->middleware("auth")
    ->name("tags.edit");
Route::put("/tags/{tag:id}", [TagController::class, "update"])
    ->middleware("auth")
    ->name("tags.update");
Route::post("/tags", [TagController::class, "store"])
    ->middleware(["auth", "api"])
    ->name("tags.store");

Route::get('/tags/{tag}', [TagController::class, "show"]);

// Page Route
Route::get("/page/{id}", [PageController::class, "show"]);

// Page Admin
Route::get("/posts/create", [PostController::class, "create"])
    ->middleware("auth");
Route::post("/posts", [PostController::class, "store"])
    ->middleware("auth");
Route::get("/posts/edit/{post}", [PostController::class, "edit"])
    ->middleware("auth")
    ->name("posts.edit");
Route::put("/posts/{post}", [PostController::class, "update"])
    ->middleware("auth");

Route::get("/posts/datagrid", [PostController::class, "datagrid"])
    ->middleware("auth")
    ->name("posts.datagrid");

Route::get("/comments/datagrid", [CommentController::class, "datagrid"])
    ->middleware("auth")
    ->name("comments.datagrid");
Route::post("/comments/status", [CommentController::class, 'status'])
    ->middleware('auth')
    ->name('comments.status');

Route::get("/comments/trash/{comment}", [CommentController::class, "trash"])
    ->middleware("auth")
    ->name("comments.trash")
    ->withTrashed();

Route::get("/comments/delete/{comment}", [CommentController::class, "delete"])
    ->middleware("auth")
    ->name("comments.delete")
    ->withTrashed();


Route::get("/categories", [CategoryController::class, "index"])
    ->middleware("auth")
    ->name("categories.index");
Route::post("/categories", [CategoryController::class, "store"])
    ->middleware("auth")
    ->name("categories.store");

Route::get("/messenger", [MessengerController::class, "index"])->middleware("auth")->name("messenger.index");
Route::get("/messenger/{user}", [MessengerController::class, "conversation"])->middleware(["auth", "api"])->name("messenger.conversation");
Route::post("/messenger/{user}", [MessengerController::class, "send"])->middleware(["auth"])->name("messenger.send");

Route::middleware("guest")->group(
    function () {
        Route::get("/auth/mobile", [AuthMobileLoginController::class, "view"]);
        Route::post("/auth/mobile/otp", [AuthMobileLoginController::class, "sendOTP"]);
        Route::post("/auth/mobile/verify", [AuthMobileLoginController::class, "verifyOtp"]);
    }
);

require __DIR__ . '/auth.php';
