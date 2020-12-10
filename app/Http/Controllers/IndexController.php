<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    // статические страницы отображаемые всегда
    private const STATIC_PAGES = [
        'services' => 'Услуги',
        'portfolio' => 'Портфолио',
        'clients' => 'Клиенты',
        'team' => 'Команда',
        'contact' => 'Контакты',
    ];

    // кол-во отображаемых сотрудников
    private const PEOPLES_SHOW_COUNT = 3;

    /**
     * Отправка сообщений из формы Контакты
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function contact(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ];
        $messages = [
            'require' => "Поле :attribute обязательно к заполнению",
            'email' => "Поле :attribute должно содержать корректный email-адрес",
        ];
        $this->validate($request, $rules, $messages);

        $data = $request->all();

        try {
            Mail::send('email.contact', ['data' => $data], function ($message) use ($data) {
                $message->from($data['email'], $data['name'])
                    ->to(env('MAIL_MANAGER'), env('MAIL_MANAGER_NAME'))
                    ->subject('Question');
            });
        } catch (\Exception $e) {
            return redirect(URL::previous() . "#contact")
                ->withErrors(['mail-status' => $e->getMessage()]);
        }

        return redirect(URL::previous() . "#contact")
            ->with('mail-status', 'Email is send');
    }

    /**
     * Отображение индексной страницы со всем секциями
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        $pages = $this->getPages();
        $menu = $this->getMenu($pages);

        $portfolios = $this->getPortfolios();
        $portfolioTags = $this->getPortfolioFilter($portfolios);

        return view('default.index', [
            'menu' => $menu,
            'pages' => $pages,
            'services' => $this->getServices(),
            'portfolios' => $portfolios,
            'tags' => $portfolioTags,
            'peoples' => $this->getPeoples(),
        ]);
    }

    /**
     * Получение списка динамических страниц и их содержимого
     * @return array
     */
    private function getPages(): array
    {
        $fields = ['name', 'alias', 'content', 'images'];

        return $this->getSectionInfo('Page', $fields);
    }

    /**
     * Формирования списка меню из списков динамичных и статичных страниц
     * @param array $pages
     * @return array
     */
    private function getMenu(array $pages): array
    {
        // список меню из динамичных страниц
        $pageMenu = [];
        foreach ($pages as $page) {
            $pageMenu[$page['alias']] = $page['name'];
        }

        return array_merge($pageMenu, self::STATIC_PAGES);
    }

    /**
     * Получение списка услуг
     * @return array
     */
    private function getServices(): array
    {
        $fields = ['name', 'text', 'icon'];

        return $this->getSectionInfo('Service', $fields);
    }

    /**
     * Получение списка портфолио
     * фильтры к портфолио в БД хранятся в виде строки через запятую
     * @return array
     */
    private function getPortfolios(): array
    {
        $fields = ['name', 'image', 'filter'];
        $portfolios = $this->getSectionInfo('Portfolio', $fields);

        foreach ($portfolios as &$portfolio) {
            $array = explode(',', $portfolio['filter']);
            $filter = array_combine(
                array_map(['Str', 'slug'], $array),
                $array
            );

            // список фильтров
            $portfolio['filter'] = $filter;
            // фильтры для js сортировки
            $portfolio['filters'] = implode(' ', array_keys($filter));
        }
        unset($portfolio);

        return $portfolios;
    }

    /**
     * Список уникальных фильтров используемых во всех портолио
     * @param array $portfolios
     * @return array
     */
    private function getPortfolioFilter(array $portfolios): array
    {
        $lists = [];
        foreach ($portfolios as $portfolio) {
            $lists[] = $portfolio['filter'];
        }

        // преобразовываем в одномерный
        $filters = array_unique(
            array_merge(...array_values($lists))
        );

        asort($filters);

        return $filters;
    }

    /**
     * Список сотрудников
     * @return array
     */
    private function getPeoples(): array
    {
        $fields = ['name', 'position', 'images', 'text'];

        return $this->getSectionInfo('People', $fields);
    }

    /**
     * Получение данных для секций
     * @param string $section - модель для получения данных
     * @param array  $fields  - выгружаемые поля
     * @return array
     */
    private function getSectionInfo(string $section, array $fields): array
    {
        $model = 'App\Models\\' . $section;

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

        $list = [];
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
