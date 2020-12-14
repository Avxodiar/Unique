<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioAddRequest;
use App\Http\Requests\PortfolioEditRequest;
use App\Models\Portfolio;
use App\Support\SectionTrait;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    use SectionTrait;

    private const SECTION_NAME = 'Portfolio';

    private const HAS_IMAGE = true;
    private const IMAGE_FIELD_NAME = 'image';

    private const INDEX_FIELDS = [
        'name' => 'Название',
        'filter' => 'Фильтры',
    ];

    /**
     * Создание страницы
     * @param PortfolioAddRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(PortfolioAddRequest $request)
    {
        return $this->createElement($request);
    }

    /**
     * Изменение страницы
     * @param PortfolioEditRequest $request
     * @param                      $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PortfolioEditRequest $request, $id)
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
        return Portfolio::find($id);
    }
}
