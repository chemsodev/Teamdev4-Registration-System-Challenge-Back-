<?php
// Middleware للتحقق من صلاحيات المسؤول
/**
 * Authenticate Middleware
 * 
 * - يتحقق من أن المستخدم قد قام بتسجيل الدخول قبل الوصول إلى الموارد المحمية.
 * - يتم تطبيقه على جميع المسارات المحمية في التطبيق.
 * 
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * معالجة الطلب للتحقق من تسجيل الدخول.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // تحقق إذا كان المستخدم غير مسجل الدخول
        if (!Auth::check()) {
            // إعادة توجيه المستخدم إلى صفحة تسجيل الدخول
            return redirect('/login')->with('error', 'يرجى تسجيل الدخول للوصول إلى هذه الصفحة.');
        }

        // إذا كان مسجل الدخول، استمر إلى الطلب التالي
        return $next($request);
    }
}
