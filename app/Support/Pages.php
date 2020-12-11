<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class Pages
{
    // статические страницы отображаемые всегда
    private const STATIC_PAGES = [
        'services' => 'Услуги',
        'portfolio' => 'Портфолио',
        'clients' => 'Клиенты',
        'team' => 'Команда',
        'contact' => 'Контакты',
    ];

    // список необходимых полей моделей данных
    public const MODEL_FIELDS = [
        'Page' => ['name', 'alias', 'content', 'images'],
        'People' => ['name', 'position', 'images', 'text'],
        'Portfolio' => ['name', 'image', 'filter'],
        'Service' => ['name', 'text', 'icon'],
    ];

    // кол-во отображаемых сотрудников
    private const PEOPLES_SHOW_COUNT = 3;

    // время хранения кэша данных для моделей
    private const MODEL_DATA_CACHE_TIME = 3600;

    /**
     * Формирования списка меню из списков динамичных и статичных страниц
     * @return array
     */
    public static function menu(): array
    {
        $pages = self::getModelData('Page');

        // список меню из динамичных страниц
        $pageMenu = [];
        foreach ($pages as $page) {
            $pageMenu[$page['alias']] = $page['name'];
        }

        return array_merge($pageMenu, self::STATIC_PAGES);
    }

    /**
     * Получение данных для секций
     * @param string $section - имя модели для получения данных
     * @return array
     */
    public static function getModelData(string $section): array
    {
        if (!isset(self::MODEL_FIELDS[$section])) {
            return [];
        }

        $cacheKey = 'section-' . $section;

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        $model = 'App\Models\\' . $section;
        $fields = self::MODEL_FIELDS[$section];
        array_unshift($fields, "id");

        switch ($section) {
            case 'Page':
            case 'Service':
            case 'Portfolio':
                $res = $model::get($fields);
                break;
            case 'People':
                $res = $model::take(self::PEOPLES_SHOW_COUNT)->get($fields);
                break;
            default:
                return [];
        }

        $result = self::toArray($res, $fields);

        Cache::put($cacheKey, $result, self::MODEL_DATA_CACHE_TIME);

        return $result;
    }

    /**
     * Преобразование коллекций в ассоц.массив
     * @param       $res    - коллекции Illuminate\Database\Eloquent\Collection
     * @param array $fields - список необходимых полей
     * @return array
     */
    public static function toArray($res, array $fields): array
    {
        $list = [];

        if (empty($res) || empty($fields)) {
            return $list;
        }

        foreach ($res as $row) {
            $array = [];
            foreach ($fields as $field) {
                $array[$field] = $row->$field;
            }

            $list[] = $array;
        }

        return $list;
    }
}
