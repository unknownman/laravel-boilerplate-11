<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    //
    public function show($id): Response
    {
        return Inertia::render("Pages/Show", compact("id"));
    }
}
