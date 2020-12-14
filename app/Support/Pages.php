<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
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
     * для секции 'People' по умолчанию выводится только PEOPLES_SHOW_COUNT записей
     * @param string $section - имя модели для получения данных
     * @param bool   $full    - возвращать все записи, включая секцию 'People'
     * @return array
     */
    public static function getModelData(string $section, bool $full = false): array
    {
        if (!isset(self::MODEL_FIELDS[$section])) {
            return [];
        }

        $cacheKey = self::getSectionKey($section);
        $ttl = self::MODEL_DATA_CACHE_TIME;

        $result = Cache::remember($cacheKey, $ttl, function () use ($section) {
            $model = 'App\Models\\' . $section;
            $fields = self::MODEL_FIELDS[$section];
            array_unshift($fields, "id");

            $res = $model::get($fields);

            return self::toArray($res, $fields);
        });

        // для секции 'People' по умолчанию выводится только PEOPLES_SHOW_COUNT записей
        if (!$full && $section === 'People') {
            $result = array_slice($result, 0, self::PEOPLES_SHOW_COUNT);
        }

        return $result;
    }

    /**
     * Преобразование коллекций в ассоц.массив
     * @param mixed $res    - коллекции Illuminate\Database\Eloquent\Collection
     * @param array $fields - список необходимых полей
     * @return array
     */
    public static function toArray($res, array $fields = []): array
    {
        $list = [];

        if (empty($res)) {
            return $list;
        }

        // если $res объект класса Мodel, то преобразовываем в коллекцию
        $res = ($res instanceof Model) ? collect([$res]) : $res;

        foreach ($res as $row) {
            $attr = $row->toArray();

            if (!empty($fields)) {
                $attr = array_intersect_key($attr, array_flip($fields));
            }

            $list[] = $attr;
        }

        return $list;
    }

    /**
     * Очистка кэша getModelData для указанной секции
     * @param string $section
     */
    public static function forgetCache(string $section): void
    {
        $cacheKey = self::getSectionKey($section);

        if (Cache::has($cacheKey)) {
            Cache::forget($cacheKey);
        }
    }

    /**
     * Ключ кэширования getModelData для указанной секции
     * @param string $section
     * @return string
     */
    private static function getSectionKey(string $section): string
    {
        return 'getModelData_' . $section;
    }
}
