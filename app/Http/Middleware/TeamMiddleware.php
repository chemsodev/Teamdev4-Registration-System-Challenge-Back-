<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class TeamMiddleware
{
    /**
     * معالجة الطلب للتحقق من انتماء المستخدم للفريق المطلوب.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // الحصول على معرف الفريق من الطلب
        $teamId = $request->route('team_id');

        // تحقق إذا كان المستخدم لا ينتمي إلى الفريق
        if (!Auth::user()->teams->contains('id', $teamId)) {
            // منع الوصول مع رسالة خطأ
            return redirect('/teams')->with('error', 'ليس لديك إذن للوصول إلى هذا الفريق.');
        }

        // إذا كان المستخدم ينتمي إلى الفريق، استمر إلى الطلب التالي
        return $next($request);
    }
}
