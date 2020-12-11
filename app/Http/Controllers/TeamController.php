<?php

namespace App\Http\Controllers;

use App\Support\Pages;
use App\Support\SectionTrait;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    use SectionTrait;

    private $active;

    public function __construct()
    {
        $this->active = AdminController::ACTION_ACTIVE;
        $this->active['team'] = 'active';
    }

    public function showPages()
    {
        $list = Pages::getModelData('People');

        $fields = [
            'name' => 'Имя',
            'position' => 'Должность',
        ];

        return view('admin.index', [
            'title' => 'Панель управления',
            'active' => $this->active,
            'section' => 'team',
            'list' => $list,
            'fields' => $fields
        ]);
    }
}
