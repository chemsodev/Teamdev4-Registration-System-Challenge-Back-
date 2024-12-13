<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * المسار الأساسي لجميع التطبيقات.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * تسجيل الـ routes الخاصة بالمشروع.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            Route::prefix('api') // يمكن أن يكون مثلاً /api للـ API Routes
                 ->middleware('api') // تحديد middleware لـ API
                 ->namespace($this->namespace)
                 ->group(base_path('routes/api.php')); // ملف الـ routes الخاص بـ API

            Route::middleware('web') // تحديد middleware للـ Web Routes
                 ->namespace($this->namespace)
                 ->group(base_path('routes/web.php')); // ملف الـ routes الخاص بـ Web
        });
    }

    /**
     * تحديد المسارات داخل الـ application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * تحديد مسارات الـ API.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api') // /api
             ->middleware('api') // middleware API
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php')); // ملف routes/api.php
    }

    /**
     * تحديد مسارات الـ Web.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web') // middleware Web
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php')); // ملف routes/web.php
    }
}
