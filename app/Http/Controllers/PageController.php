<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageAddRequest;
use App\Http\Requests\PageEditRequest;
use App\Support\Pages;
use App\Models\Page;
use App\Support\SectionTrait;

class PageController extends Controller
{
    use SectionTrait;

    protected const SECTION_NAME = 'Page';

    protected const HAS_IMAGE = true;
    protected const IMAGE_FIELD_NAME = 'images';

    private const INDEX_FIELDS = [
        'alias' => 'Псевдоним',
        'name' => 'Название',
    ];

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
     * Создание страницы
     * @param PageAddRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(PageAddRequest $request)
    {
        return $this->createElement($request);
    }

    /**
     * Изменение страницы
     * @param PageEditRequest $request
     * @param                 $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PageEditRequest $request, $id)
    {
        return $this->updateElement($request, $id);
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
