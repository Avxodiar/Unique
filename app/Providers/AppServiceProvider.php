<?php

namespace App\Providers;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Support\Pages;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // загрузка языковых значений/локализация
        Pages::boot();
        AdminController::boot();
        PageController::boot();
        ServiceController::boot();
        PortfolioController::boot();
        TeamController::boot();
    }
}
