<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Support\SectionTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use SectionTrait;

    private const SECTION_NAME = 'Service';

    private const HAS_IMAGE = false;

    private const INDEX_FIELDS = [
        'name' => 'Название',
        'icon' => 'Иконка',
    ];

    /**
     * Получение записи по id из БД
     * @param int $id
     * @return mixed
     */
    private function getElement(int $id)
    {
        return Service::find($id);
    }
}
