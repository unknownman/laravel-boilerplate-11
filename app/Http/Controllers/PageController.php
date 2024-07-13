<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Page;

class PageController extends Controller
{
    //
    public function show($id): Response
    {
        $page = Page::find($id);

        return Inertia::render("Pages/Show", compact("id", "page"));
    }
}
