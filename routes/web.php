<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobRequestController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PortfolioItemController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 1. الصفحة الرئيسية (Home / Landing Page) - تفتح للجميع
Route::get('/', function () {
    return view('home');
})->name('home');


// 2. مسارات الزوار (Guest Routes)
// يوجه تلقائياً بعيداً عنها لو المستخدم عامل تسجيل دخول بالفعل
Route::middleware('guest')->group(function () {

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // throttle:5,1 => أقصى 5 محاولات فاشلة في الدقيقة لكل (email + IP) لمنع brute-force
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.submit');

});


// 3. مسارات المستخدمين المسجلين (Authenticated Routes)
// كل route هنا محمي بالدور الصح (role) مش بس بتسجيل الدخول،
// عشان عميل/صنايعي ميقدروش يفتحوا داشبورد الأدمن بمجرد كتابة الرابط.
Route::middleware('auth')->group(function () {

    // Dashboard الأدمن (Admin)
    Route::middleware('role:admin')->get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // ==== مسارات العميل (Client) ====
    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'client'])->name('dashboard');

        // إدارة الطلبات
        Route::get('/job-requests', [JobRequestController::class, 'myRequests'])->name('job-requests.index');
        Route::get('/job-requests/create', [JobRequestController::class, 'create'])->name('job-requests.create');
        Route::post('/job-requests', [JobRequestController::class, 'store'])->name('job-requests.store');
        Route::post('/job-requests/{jobRequest}/complete', [JobRequestController::class, 'complete'])->name('job-requests.complete');
        Route::post('/job-requests/{jobRequest}/cancel', [JobRequestController::class, 'cancel'])->name('job-requests.cancel');

        // التعامل مع العروض
        Route::post('/offers/{offer}/accept', [OfferController::class, 'accept'])->name('offers.accept');
        Route::post('/offers/{offer}/reject', [OfferController::class, 'reject'])->name('offers.reject');

        // الدفع الوهمي (بيبقى متاح بعد إغلاق الطلب)
        Route::get('/job-requests/{jobRequest}/pay', [PaymentController::class, 'show'])->name('payments.show');
        Route::post('/job-requests/{jobRequest}/pay', [PaymentController::class, 'process'])->name('payments.process');

        // التقييم بعد إغلاق الطلب والدفع
        Route::post('/job-requests/{jobRequest}/review', [ReviewController::class, 'store'])->name('reviews.store');

    });

    // ==== مسارات الصنايعي (Worker) ====
    Route::middleware('role:worker')->prefix('worker')->name('worker.')->group(function () {

       Route::get('/dashboard', [DashboardController::class, 'worker'])->name('dashboard');

        // تصفح الطلبات المفتوحة وبعت عرض
        Route::get('/job-requests', [JobRequestController::class, 'browse'])->name('job-requests.browse');
        Route::post('/job-requests/{jobRequest}/offers', [OfferController::class, 'store'])->name('offers.store');

        // البورتفوليو
        Route::get('/portfolio', [PortfolioItemController::class, 'index'])->name('portfolio.index');
        Route::get('/portfolio/create', [PortfolioItemController::class, 'create'])->name('portfolio.create');
        Route::post('/portfolio', [PortfolioItemController::class, 'store'])->name('portfolio.store');
        Route::delete('/portfolio/{portfolioItem}', [PortfolioItemController::class, 'destroy'])->name('portfolio.destroy');

    });

    // مشترك بين العميل والصنايعي: عرض تفاصيل طلب معين
    Route::get('/job-requests/{jobRequest}', [JobRequestController::class, 'show'])->name('job-requests.show');

});


// ==== صفحات عامة (تفتح للجميع، حتى الزوار) ====
// بروفايل صنايعي عام: البورتفوليو + التقييمات
Route::get('/workers/{worker}/portfolio', [PortfolioItemController::class, 'showForWorker'])->name('workers.portfolio');
Route::get('/workers/{worker}/reviews', [ReviewController::class, 'forWorker'])->name('workers.reviews');

// Public Information Pages
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/support', [PageController::class, 'support'])->name('support');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

// 4. مسار تسجيل الخروج (Logout)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');