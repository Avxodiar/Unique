<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Пользовательская часть
 */
Route::middleware('web')->group(function () {

    // Отображение основного контента
    Route::get('/', [IndexController::class, 'show'])
        ->name('home');

    // Отправка сообщений из формы Контакты
    Route::post('/', [IndexController::class, 'contact']);

    // дополнительные страницы для секций с кнопками "Читать дальше"
    Route::get('/page/{alias}', [PageController::class, 'show'])
        ->name('page');
});

/**
 * Аутентификация пользователя
 */
Route::middleware('web')->group(function () {

    Route::get('registration', [AdminController::class, 'showRegistration'])->name('registration');
    Route::post('registration', [ AdminController::class, 'registration']);

    Route::get('login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminController::class, 'login']);

    Route::match(['get','post'],'logout', [AdminController::class, 'logout'])->name('logout');

});

/**
 * Администраторская часть
 */
Route::prefix('admin')->middleware('auth')->group(function () {

    // Основная страница админки /admin
    Route::get('/', function() {
         return view('admin.index')
            ->with('sectionActive', AdminController::ACTION_ACTIVE);
    })->name('admin');

    // Изменение дополнительных страниц
    Route::prefix('pages')->group(function () {
        // Вывод списка страниц /admin/pages
        Route::get('/', [PageController::class, 'showIndex'])->name('page-list');

        // Добавление страницы /admin/pages/add
        Route::get('add', [PageController::class, 'showAddForm'])->name('add-page');
        Route::post('add', [PageController::class, 'create']);

        // Форма редактирования содержимого страницы /admin/pages/edit/{id}
        Route::get('edit/{id}', [PageController::class, 'showEditForm'])
            ->where('id', '[0-9]+')
            ->name('edit-page');

        Route::post('edit/{id}', [PageController::class, 'update'])
            ->where('id', '[0-9]+');

        // Удаление страницы
        Route::delete('delete/{id}', [PageController::class, 'delete'])
            ->where('id', '[0-9]+')
            ->name('delete-page');
    });

    // Изменение портфолио
    Route::prefix('portfolio')->group(function () {
        // Вывод списка портфолио /admin/portfolio
        Route::get('/', [PortfolioController::class, 'showIndex'])->name('portfolio-list');

        // Добавление портфолио /admin/portfolio/add
        Route::get('/add', [PortfolioController::class, 'showAddForm'])->name('add-portfolio');
        Route::post('/add', [PortfolioController::class, 'create']);

        // Форма редактирования портфолио /admin/portfolio/edit/{id}
        Route::get('/edit/{id}', [PortfolioController::class, 'showEditForm'])->name('edit-portfolio');
        Route::post('/edit/{id}', [PortfolioController::class, 'update']);

        // Удаление работы из портфолио
        Route::delete('/delete/{id}', [PortfolioController::class, 'delete'])->name('delete-portfolio');
    });

    // Изменение услуг
    Route::prefix('services')->group(function () {

        // Вывод списка услуг /admin/services
        Route::get('/', [ServiceController::class, 'showIndex'])->name('service-list');

        // Добавление услуги /admin/services/add
        Route::get('/add', [ServiceController::class, 'showAddForm'])->name('add-service');
        Route::post('/add', [ServiceController::class, 'create']);

        // Форма редактирования услуги /admin/services/edit/{id}
        Route::get('/edit/{id}', [ServiceController::class, 'showEditForm'])->name('edit-service');
        Route::post('/edit/{id}', [ServiceController::class, 'update']);

        // Удаление услуги
        Route::delete('/delete/{id}', [ServiceController::class, 'delete'])->name('delete-service');
    });

    // Изменение команды
    Route::prefix('team')->group(function () {
        // Вывод имеющихся страниц /admin/services
        Route::get('/', [TeamController::class, 'showIndex'])->name('people-list');

        // Добавление работника /admin/services/add
        Route::get('/add', [TeamController::class, 'showAddForm'])->name('add-people');
        Route::post('/add', [TeamController::class, 'create']);

        // Форма редактирования информации о работнике /admin/services/edit/{id}
        Route::get('/edit/{id}', [TeamController::class, 'showEditForm'])->name('edit-people');
        Route::post('/edit/{id}', [TeamController::class, 'update']);

        // Удаление работника
        Route::delete('/delete/{id}', [TeamController::class, 'delete'])->name('delete-people');
    });
});
