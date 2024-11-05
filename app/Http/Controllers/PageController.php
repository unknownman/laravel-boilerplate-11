<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Services\PageService;

class PageController extends Controller
{
    private $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    //
    public function show($id): Response
    {
        $page = $this->pageService->getPageById($id);

        return Inertia::render("Pages/Show", compact("id", "page"));
    }
}
