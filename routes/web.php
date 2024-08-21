<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

// Page Route
Route::get("/page/{id}", [PageController::class, "show"]);
require __DIR__ . '/auth.php';
