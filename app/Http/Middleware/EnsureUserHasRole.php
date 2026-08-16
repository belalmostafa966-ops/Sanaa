<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    /**
     * يتأكد إن المستخدم مسجل الدخول عنده الدور (role) المطلوب
     * قبل ما يدخل على الـ route ده. لو دوره مختلف، بيتحول
     * تلقائياً لداشبورده الصح بدل ما ياخد 403 مربكة.
     *
     * الاستخدام في routes: ->middleware('role:admin')
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! in_array($user->role, $roles, true)) {
            abort(403, 'غير مصرح لك بالوصول لهذه الصفحة.');
        }

        return $next($request);
    }
}
