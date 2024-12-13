<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // Middleware الأساسية لتأمين التطبيق
        \App\Http\Middleware\Authenticate::class, // التحقق من تسجيل الدخول
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // ميدل وور لتعامل الطلبات من المتصفح
            \App\Http\Middleware\Authenticate::class, // التحقق من تسجيل الدخول
        ],

        'api' => [
            // ميدل وور لتعامل طلبات الـ API
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class, // للتحقق من المستخدم
        'admin' => \App\Http\Middleware\AdminMiddleware::class, // للتحقق من صلاحيات المسؤول
        'team' => \App\Http\Middleware\TeamMiddleware::class, // للتحقق من صلاحيات أعضاء الفريق
    ];
}

