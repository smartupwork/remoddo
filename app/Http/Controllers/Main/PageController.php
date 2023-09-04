<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    public function page(Page $static_page)
    {
       
        $page = $static_page;
        return view('main.pages.static.index', compact('page'));
    }
}
