<?php

namespace App\Http\Controllers;

use App\Support\Pages;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    /**
     * Отправка сообщений из формы Контакты
     * @param ContactRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function contact(ContactRequest $request)
    {
        $data = $request->all();

        if(empty(env('MAIL_MANAGER'))) {
            return redirect(URL::previous() . "#contact")
                ->withErrors(['mail-status' => __('index.no_mail_manager')]);
        }

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
            ->with('mail-status', __('index.mail_send'));
    }

    /**
     * Отображение индексной страницы со всем секциями
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show()
    {
        return view('default.index', [
            'menu' => Pages::menu(),
            'pages' => Pages::getModelData('Page'),
            'peoples' => Pages::getModelData('People'),
            'services' => Pages::getModelData('Service'),
            'portfolios' => $this->getPortfolios(),
            'portfolioTags' => $this->getPortfolioFilter(),
        ]);
    }

    /**
     * Получение списка портфолио
     * фильтры к портфолио в БД хранятся в виде строки через запятую
     * фильтры приводятся к kebab-case виду при помощи Str::slug()
     * @return array
     */
    private function getPortfolios(): array
    {
        $portfolios = Pages::getModelData('Portfolio');

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
     * @return array
     */
    private function getPortfolioFilter(): array
    {
        $portfolios = $this->getPortfolios();

        $lists = array_column($portfolios, 'filter');

        $array = Arr::collapse($lists);

        return Arr::sort($array);
    }
}
