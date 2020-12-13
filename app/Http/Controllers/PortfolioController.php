<?php

namespace App\Http\Controllers;

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
     * Получение записи по id из БД
     * @param int $id
     * @return mixed
     */
    private function getElement(int $id)
    {
        return Portfolio::find($id);
    }
}
