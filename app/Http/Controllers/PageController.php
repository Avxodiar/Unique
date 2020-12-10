<?php

namespace App\Http\Controllers;

use App\Support\Pages;
use App\Models\Page;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show($alias)
    {
        $alias = strip_tags($alias);

        $res = Page::where('alias', $alias)->firstOrFail();
        $page = Pages::toArray([$res], Pages::MODEL_FIELDS['Page']);

        return view('default.page', [
            'menu' => Pages::menu(),
            'page' => current($page)
        ]);
    }
}
