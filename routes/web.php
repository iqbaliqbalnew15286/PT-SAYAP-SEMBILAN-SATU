<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

// Auth & Booking Controllers
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\VerifyCodeController;
use App\Http\Controllers\BookingAuthController;

// Frontend & Admin Controllers
use App\Http\Controllers\PublicTestimonialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\ReservationController;

// Models
use App\Models\Product;
use App\Models\Gallery;
use App\Models\About;
use App\Models\Reservation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== 1. FRONTEND / PUBLIC ROUTES ====================
Route::get('/', [AdminHomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    $about = About::first();
    return view('pages.about', compact('about'));
})->name('about');

Route::get('/search', function (Request $request) {
    $query = $request->get('query');
    if (!$query) return redirect()->back()->with('error', 'Silakan masukkan kata kunci.');

    $products = Product::where('type', 'barang')
        ->where(function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        })->get();

    $services = Product::where('type', 'jasa')
        ->where(function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        })->get();

    return view('pages.search.results', compact('products', 'services', 'query'));
})->name('search');

// Produk & Galeri
Route::get('/products', function () {
    $items = Product::latest()->get();
    return view('pages.products.products', compact('items'));
})->name('products');

Route::get('/services', function () {
    $items = Product::where('type', 'jasa')->latest()->get();
    return view('pages.services.services', compact('items'));
})->name('services');

Route::get('/products/{slug}', function ($slug) {
    $product = Product::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();
    $recommended_products = Product::where('id', '!=', $product->id)->latest()->take(4)->get();
    return view('pages.products.show', compact('product', 'recommended_products'));
})->name('product.show');

Route::get('/services/{slug}', function ($slug) {
    $service = Product::where('type', 'jasa')->where('slug', $slug)->orWhere('id', $slug)->firstOrFail();
    $recommended_services = Product::where('type', 'jasa')->where('id', '!=', $service->id)->latest()->take(4)->get();
    return view('pages.services.show', compact('service', 'recommended_services'));
})->name('service.show');

Route::get('/gallery', function () {
    $galleries = Gallery::latest()->get();
    return view('pages.gallery.gallery', compact('galleries'));
})->name('gallery.index');

// Partners, Facilities, & Help
Route::resource('partners', \App\Http\Controllers\Admin\PublicPartnersController::class)->only(['index', 'show']);
Route::resource('facilities', \App\Http\Controllers\Admin\PublicFacilityController::class)->only(['index', 'show']);
Route::view('/contact', 'contact')->name('contact');
Route::view('/consult', 'pages.consult')->name('consult');
Route::view('/faq', 'pages.help.faq')->name('faq');
Route::view('/syaratketentuan', 'pages.help.syaratketentuan')->name('syaratketentuan');
Route::view('/kontak', 'pages.help.kontak')->name('kontak');

// Testimonials
Route::get('/testimonial', [PublicTestimonialController::class, 'create'])->name('send.testimonial');
Route::post('/testimonial', [PublicTestimonialController::class, 'store'])->name('testimonial.store');

// Feedback
Route::get('/feedback', [App\Http\Controllers\FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback', [App\Http\Controllers\FeedbackController::class, 'store'])->name('feedback.store');


// ==================== 2. BOOKING SYSTEM (USER AUTH) ====================
Route::prefix('booking')->group(function () {

    // Guest Only (Halaman Login, Register, & Reset Password)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [BookingAuthController::class, 'showLogin'])->name('booking.login');
        Route::post('/login', [BookingAuthController::class, 'login'])->name('booking.login.post');
        Route::get('/register', [BookingAuthController::class, 'showRegister'])->name('booking.register');
        Route::post('/register', [BookingAuthController::class, 'register'])->name('booking.register.post');

        // Reset Password User
        Route::get('/reset', [BookingAuthController::class, 'showReset'])->name('booking.reset');
        Route::post('/reset', [BookingAuthController::class, 'sendResetLink'])->name('booking.reset.post');

        // Route 'password.reset' sangat krusial, link di email akan mencari nama route ini
        Route::get('/reset-password/{token}', [BookingAuthController::class, 'showResetPasswordForm'])->name('password.reset');
        Route::post('/reset-password', [BookingAuthController::class, 'resetPassword'])->name('booking.reset.password.post');
    });

    // Auth Only (User Panel)
    Route::middleware('auth')->group(function () {
        Route::get('/', function () {
            $products = Product::where('type', 'barang')->latest()->get();
            $services = Product::where('type', 'jasa')->latest()->get();
            return view('pages.booking.booking', compact('products', 'services'));
        })->name('booking.index'); // Nama route diganti ke booking.index agar sinkron dengan Controller

        // Halaman Riwayat & Simpan Booking
        Route::get('/riwayat', [BookingAuthController::class, 'riwayat'])->name('booking.riwayat');
        Route::post('/riwayat', [BookingAuthController::class, 'storeBooking'])->name('booking.riwayat.store');

        Route::post('/logout', [BookingAuthController::class, 'logout'])->name('booking.logout');
    });

    Route::get('/verify', function () {
        return view('pages.booking.verify');
    })->name('booking.verify');
});


// ==================== 3. ADMIN SYSTEM (ADMIN AUTH) ====================

// Admin Login
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

// Admin Password Reset
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/verify-code', [VerifyCodeController::class, 'showVerifyForm'])->name('password.verify');
Route::post('/verify-code', [VerifyCodeController::class, 'verifyCode'])->name('password.verify.post');
Route::get('/change-password', [VerifyCodeController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/change-password', [VerifyCodeController::class, 'changePassword'])->name('password.change.post');

// Admin Dashboard & CMS
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('home', AdminHomeController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('products', ProductController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
    Route::resource('facilities', \App\Http\Controllers\Admin\FacilityController::class);

    Route::resource('feedbacks', FeedbackController::class);

    // Manajemen Booking di sisi Admin
    Route::resource('booking', ReservationController::class);
});


// ==================== 4. STORAGE FALLBACK ====================
Route::get('storage/{path}', function ($path) {
    $storagePath = storage_path('app/public/' . $path);
    if (!Storage::disk('public')->exists($path)) abort(404);
    return response()->file($storagePath);
})->where('path', '.*')->name('storage.local');
