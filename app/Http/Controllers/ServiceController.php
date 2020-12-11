<?php

namespace App\Http\Controllers;

use App\Support\Pages;
use App\Support\SectionTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use SectionTrait;

    private $active;

    public function __construct()
    {
        $this->active = AdminController::ACTION_ACTIVE;
        $this->active['services'] = 'active';
    }

    public function showPages()
    {
        $list = Pages::getModelData('Service');

        $fields = [
            'name' => 'Название',
            'icon' => 'Иконка',
        ];

        return view('admin.index', [
            'title' => 'Панель управления',
            'active' => $this->active,
            'section' => 'service',
            'list' => $list,
            'fields' => $fields
        ]);
    }
}
