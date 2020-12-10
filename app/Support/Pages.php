<?php

namespace App\Support;

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

    /**
     * Формирования списка меню из списков динамичных и статичных страниц
     * @param array $pages
     * @return array
     */
    public static function menu(array $pages): array
    {
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

        $model = 'App\Models\\' . $section;
        $fields = self::MODEL_FIELDS[$section];

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

        return self::toArray($res, $fields);
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
