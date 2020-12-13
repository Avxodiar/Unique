<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Support\SectionTrait;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    use SectionTrait;

    private const SECTION_NAME = 'People';

    private const HAS_IMAGE = false;

    private const INDEX_FIELDS = [
        'name' => 'Имя',
        'position' => 'Должность',
    ];

    /**
     * Получение записи по id из БД
     * @param int $id
     * @return mixed
     */
    private function getElement(int $id)
    {
        return People::find($id);
    }
}
