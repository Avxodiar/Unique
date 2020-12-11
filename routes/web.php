<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PageController;
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
        return view('admin.index');
    })->name('admin');

    // Изменение дополнительных страниц
    Route::prefix('pages')->group(function () {

        // Вывод имеющихся страниц /admin/pages
        Route::get('/', function () {
           return 'PageController@list';
        })->name('pages');

        // Добавление страницы /admin/pages/add
        Route::get('/add', function () {
            return 'PageController@addForm';
        })->name('add-page');

        Route::post('/add', function () {
            return 'PageController@create';
        });

        // Форма редактирования содержимого страницы /admin/pages/edit/{id}
        Route::get('/edit/{id}', function () {
            return 'PageController@editForm';
        })->name('edit-page');

        Route::post('/edit/{id}', function () {
            return 'PageController@update';
        });

        Route::delete('/edit/{id}', function () {
            return 'PageController@delete';
        });
    });

    // Изменение портфолио
    Route::prefix('portfolio')->group(function () {

        // Вывод имеющихся страниц /admin/portfolio
        Route::get('/', function () {
            return 'PortfolioController@show';
        })->name('portfolio');

        // Добавление страницы /admin/portfolio/add
        Route::get('/add', function () {
            return 'PortfolioController@addForm';
        })->name('add-portfolio');

        Route::post('/add', function () {
            return 'PortfolioController@create';
        });

        // Форма редактирования содержимого страницы /admin/portfolio/edit/{id}
        Route::get('/edit/{id}', function () {
            return 'PortfolioController@editForm';
        })->name('edit-portfolio');

        Route::post('/edit/{id}', function () {
            return 'PortfolioController@update';
        });

        Route::delete('/edit/{id}', function () {
            return 'PortfolioController@delete';
        });
    });

    // Изменение сервисов
    Route::prefix('services')->group(function () {

        // Вывод имеющихся страниц /admin/services
        Route::get('/', function () {
            return 'ServiceController@show';
        })->name('services');

        // Добавление страницы /admin/services/add
        Route::get('/add', function () {
            return 'ServiceController@addForm';
        })->name('add-service');

        Route::post('/add', function () {
            return 'ServiceController@create';
        });

        // Форма редактирования содержимого страницы /admin/services/edit/{id}
        Route::get('/edit/{id}', function () {
            return 'ServiceController@editForm';
        })->name('edit-service');

        Route::post('/edit/{id}', function () {
            return 'ServiceController@update';
        });

        Route::delete('/edit/{id}', function () {
            return 'ServiceController@delete';
        });
    });
});
