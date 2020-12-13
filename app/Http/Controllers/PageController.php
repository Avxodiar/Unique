<?php

namespace App\Http\Controllers;

use App\Support\Pages;
use App\Models\Page;
use App\Support\SectionTrait;
use Illuminate\Http\Request;

class PageController extends Controller
{
    use SectionTrait;

    private const SECTION_NAME = 'Page';

    private const HAS_IMAGE = true;
    private const IMAGE_FIELD_NAME = 'images';

    private const INDEX_FIELDS = [
        'alias' => 'Псевдоним',
        'name' => 'Название',
    ];

    private $fields;

    public function __construct()
    {
        //$this->fields = Pages::MODEL_FIELDS['Page'];
    }

    /**
     * Показ выбранной страницы в публичной части
     * @param $alias - псевдоним страницы /page/$alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($alias)
    {
        $alias = strip_tags($alias);

        $res = Page::where('alias', $alias)->firstOrFail();
        $page = Pages::toArray($res);

        return view('default.page', [
            'menu' => Pages::menu(),
            'page' => current($page)
        ]);
    }

    /**
     * Получение записи по id из БД
     * @param int $id
     * @return mixed
     */
    private function getElement(int $id)
    {
        return Page::find($id);
    }
}
