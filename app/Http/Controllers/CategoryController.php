<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Notifications\CategoryCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    public function index() {

        $categories = Category::with("children")->whereNull('parent_id')->get();

        return Inertia::render("Categories/Index", compact("categories"));
    }

    public function store(Request $request)  {
        $category = new Category();
        $category->name = request("name");
        $category->slug = Str::slug(request("name"));
        $category->parent_id = request("parent_id") ? request("parent_id") : null;
        $category->user_id = Auth::id();

        try {
            $category->save();
        } catch(\Exception $e) {
            redirect("/categories")->withErrors("خطا");
        }
        $category->notify(new CategoryCreated());
        redirect('/categories')->with("success", "با موفقیت اضافه شد");
    }
}
