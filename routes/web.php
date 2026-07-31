<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - مسارات التطبيق
|--------------------------------------------------------------------------
*/

// الصفحة الرئيسية: تفحص حالة المستخدم وتوجهه حسب نوع الحساب لتجنب Infinite Redirect
Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'worker' 
            ? redirect()->route('worker.dashboard') 
            : redirect()->route('client.dashboard');
    }
    return redirect()->route('login');
});


// ==========================================
// 1. مسارات الزوار (Guest Routes)
// (المستخدم المسجل لا يستطيع دخول هذه الصفحات)
// ==========================================
Route::middleware('guest')->group(function () {

    // تسجيل حساب جديد
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // تسجيل الدخول
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

});


// ==========================================
// 2. مسارات المسجلين (Authenticated Routes)
// (تتطلب تسجيل الدخول للوصول إليها)
// ==========================================
Route::middleware('auth')->group(function () {

    // لوحة تحكم العميل
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');

    // لوحة تحكم الصنايعي
    Route::get('/worker/dashboard', function () {
        return view('worker.dashboard');
    })->name('worker.dashboard');

    // تسجيل الخروج
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});