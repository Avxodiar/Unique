<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // список названий секций доступных для изменений
    public static $sectionName;

    // список активных/неактивных секций в панели управления
    public const ACTION_ACTIVE = [
        'page' => '',
        'service' => '',
        'portfolio' => '',
        'people' => ''
    ];

    /**
     * Загрузка языковых значений/локализация
     */
    public static function boot(): void
    {
        self::$sectionName = [
            'page' => __('admin.section.page'),
            'service' => __('admin.section.service'),
            'portfolio' => __('admin.section.portfolio'),
            'people' => __('admin.section.people')
        ];
    }

    /**
     * Возвращает имя секции
     * @param string $section - код секции
     * @return string
     */
    public static function getSectionName(string $section): string
    {
        return self::$sectionName[$section] ?? '';
    }

    /**
     * Страница авторизации
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }

        return view('admin.login')
            ->with('title', __('admin.auth'));
    }

    /**
     * Страница регистрации
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegistration()
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }

        return view('admin.registration')
            ->with('title', __('admin.register'));
    }

    /**
     * Аутентификация пользователя
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(LoginRequest $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }

        $data = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($data, $remember)) {
            return redirect()->intended(route('admin'));
        }

        return redirect(route('login'))
            ->withInput( $request->only('email','remember') )
            ->withErrors([
                'formError' => __('auth.failed')
            ]);
    }

    /**
     * Регистрация пользователя
     * @param RegistrationRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function registration(RegistrationRequest $request)
    {
        if (Auth::check()) {
            return redirect()->route('admin');
        }

        $data = $request->only('name', 'email', 'password');

        if ($this->userExist($data['email'])) {
            return redirect(route('registration'))
                ->withErrors(['formError' => __('auth.user_exists')]);
        }

        $user = User::create($data);
        if ($user) {
            Auth::login($user);

            if (Auth::check()) {
                return redirect()->route('admin');
            }
        }

        return redirect(route('registration'))
            ->withErrors(['formError' => __('auth.user_create_failed')]);
    }

    /**
     * Завершение сеанса
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();
        return redirect(route('home'));
    }

    /**
     * Проверка существует ли пользователь с указанным e-mail
     * @param string $email
     * @return bool
     */
    private function userExist(string $email): bool
    {
        return User::query()->where('email', $email)->exists();
    }
}
