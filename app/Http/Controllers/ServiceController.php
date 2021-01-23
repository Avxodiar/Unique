<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Support\SectionTrait;

class ServiceController extends Controller
{
    use SectionTrait;

    private const SECTION_NAME = 'Service';

    private const HAS_IMAGE = false;

    public static $indexFields;

    /**
     * Загрузка языковых значений/локализация
     */
    public static function boot(): void
    {
        self::$indexFields = [
            'name' => __('admin.section_fields.name'),
            'icon' => __('admin.section_fields.alias')
        ];
    }

    /**
     * Создание страницы
     * @param ServiceRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(ServiceRequest $request)
    {
        return $this->createElement($request);
    }

    /**
     * Изменение страницы
     * @param ServiceRequest $request
     * @param                 $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ServiceRequest $request, $id)
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
        return Service::find($id);
    }
}
