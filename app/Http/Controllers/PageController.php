<?php

namespace App\Http\Controllers;

use App\Support\Pages;
use App\Models\Page;
use App\Support\SectionTrait;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use SectionTrait;

    private $active;

    public function __construct()
    {
        $this->active = AdminController::ACTION_ACTIVE;
        $this->active['pages'] = 'active';
    }

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

    public function showPages()
    {
        $list = Pages::getModelData('Page');

        $fields = [
            'alias' => 'Псевдоним',
            'name' => 'Название',
        ];

        return view('admin.index', [
            'title' => 'Панель управления',
            'active' => $this->active,
            'section' => 'page',
            'list' => $list,
            'fields' => $fields
        ]);
    }
}
