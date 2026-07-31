<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. الصفحة الرئيسية (Home / Landing Page) - تفتح للجميع
Route::get('/', function () {
    return view('home');
})->name('home');



// Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

// 2. مسارات الزوار (Guest Routes)
// يوجه تلقائياً بعيداً عنها لو المستخدم عامل تسجيل دخول بالفعل
Route::middleware('guest')->group(function () {
    
    
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
});


// 3. مسارات المستخدمين المسجلين (Authenticated Routes)
Route::middleware('auth')->group(function () {

    // Dashboard الأدمن (Admin)
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Dashboard العملاء (Client)
    Route::get('/client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');

    // Dashboard الفنيين / الصنايعية (Worker)
    Route::get('/worker/dashboard', function () {
        return view('worker.dashboard');
    })->name('worker.dashboard');

});


// 4. مسار تسجيل الخروج (Logout)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');