<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class CheckCoursePayment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user(); // Получаем текущего пользователя
        $courseId = $request->route('course_id'); // Предполагается, что ID курса передается в URL 

        if (!$user) {
            return redirect()->route('login')->with('error', 'Пожалуйста, войдите в систему.');
        }

        // Проверяем наличие оплаты
        $payment = Payment::where('user_id', $user->id)
                          ->where('course_id', $courseId)
                          //->where('status', 'paid') // Убедитесь, что статус оплаты "paid" или измените на свой
                          ->first();

        if (!$payment) {
            return redirect()->route('payment.base', ['freq' => '100', 'sum' => '30000']) // Перенаправляем пользователя на страницу списка курсов
                             ->with('error', 'Вы не оплатили этот курс.');
        }

        return $next($request); // Передаем управление следующему middleware
    }
}
