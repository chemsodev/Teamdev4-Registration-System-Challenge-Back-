<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * معالجة الطلب للتحقق من صلاحيات المسؤول.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // تحقق إذا كان المستخدم مسجلًا وليس مسؤولًا
        if (!Auth::check() || !Auth::user()->is_admin) {
            // منع الوصول مع رسالة خطأ
            return redirect('/home')->with('error', 'ليس لديك الصلاحيات للوصول إلى هذه الصفحة.');
        }

        // إذا كان المستخدم مسؤولًا، استمر إلى الطلب التالي
        return $next($request);
    }
}
