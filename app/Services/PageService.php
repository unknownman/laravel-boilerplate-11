<?php

namespace App\Services;

use App\Models\Page;

class PageService
{

    public function getPageById($id)
    {

        return Page::find($id);
    }
}
