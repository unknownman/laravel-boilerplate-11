<?php

use App\Http\Controllers\CommentController;
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
Route::get("/post/{id}/{slug?}", [PostController::class, "show"]);
Route::post("/post/{id}/comment", [CommentController::class, "store"]);

// Tag Route
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

require __DIR__ . '/auth.php';
