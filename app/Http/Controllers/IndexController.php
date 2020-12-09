<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\People;
use App\Models\Portfolio;
use App\Models\Service;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // статические страницы отображаемые всегда
    const STATIC_PAGES = [
        'services' => 'Услуги',
        'portfolio' => 'Портфолио',
        'clients' => 'Клиенты',
        'team' => 'Команда',
        'contact' => 'Контакты'
    ];

    // кол-во отображаемых сотрудников
    const PEOPLES_SHOW_COUNT = 3;

    public function contact(Request $request)
    {
        return __METHOD__;
    }

    public function show()
    {
        $pages = $this->getPages();
        $menu = $this->getMenu($pages);

        $portfolios = $this->getPortfolios();
        dump($portfolios);

        $services = $this->getServices();
        dump($services);

        $peoples = $this->getPeoples();
        dump($peoples);

        return view('default.index', [
            'menuList' => $menu,
            'pages' => $pages
        ]);
    }

    /**
     * Получение списка динамических страниц и их содержимого
     * @return array
     */
    private function getPages()
    {
        $pages = Page::all();

        $pageList = [];
        foreach ($pages as $page) {
            $pageList[] = [
                'title' => $page->name,
                'alias' => $page->alias,
                'content' => $page->content,
                'images' => $page->images
            ];
        }
        return $pageList;
    }

    /**
     * Формирования списка меню из списков динамичных и статичных страниц
     * @param array $pages
     * @return array
     */
    private function getMenu(array $pages)
    {
        // список меню из динамичных страниц
        $pageMenu = [];
        foreach ($pages as $page) {
            $pageMenu[$page['alias']] = $page['title'];
        }

        return array_merge( $pageMenu, self::STATIC_PAGES);
    }

    private function getPortfolios()
    {
        return Portfolio::get(['name', 'image', 'filter']);
    }

    private function getServices()
    {
        return Service::get(['name', 'text', 'icon']);
    }

    private function getPeoples()
    {
        return People::take(self::PEOPLES_SHOW_COUNT)->get(['name', 'position', 'images', 'text']);
    }
}
