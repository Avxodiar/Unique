<?php

namespace App\Http\Controllers;

use App\Support\Pages;
use App\Support\SectionTrait;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    use SectionTrait;

    private $active;

    public function __construct()
    {
        $this->active = AdminController::ACTION_ACTIVE;
        $this->active['portfolio'] = 'active';
    }

    public function showPages()
    {
        $list = Pages::getModelData('Portfolio');

        $fields = [
            'name' => 'Название',
            'filter' => 'Фильтры',
        ];

        return view('admin.index', [
            'title' => 'Панель управления',
            'active' => $this->active,
            'section' => 'portfolio',
            'list' => $list,
            'fields' => $fields
        ]);
    }
}
