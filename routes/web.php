<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\PublicTestimonialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Models\Product;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\About;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== 🏠 FRONTEND / PUBLIC ====================

// Home Page
Route::get('/', function () {
    $products = Product::latest()->take(4)->get();
    $services = Service::latest()->take(4)->get();
    $testimonials = Testimonial::latest()->take(3)->get();
    $galleryItems = Gallery::latest()->take(4)->get();

    $advantages = [
        'Tenaga Profesional & Bersertifikasi',
        'Pelayanan Homecare & Onsite',
        'Fasilitas Lengkap & Nyaman',
        'Prioritas Keamanan dan Higienitas',
        'Konsultasi Gratis Sebelum Tindakan',
        'Buka Setiap Hari (By Appointment)',
    ];

    return view('welcome', compact(
        'products',
        'services',
        'testimonials',
        'galleryItems',
        'advantages'
    ));
})->name('home');


// ✅ Dynamic About (Visi, Misi, Tujuan dari CMS)
Route::get('/about', function () {
    $about = About::first(); // hanya ada 1 record
    return view('pages.about', compact('about'));
})->name('about');


// Static Pages
Route::get('/booking', function () {
    $products = \App\Models\Product::latest()->get();
    $services = \App\Models\Service::latest()->get();
    return view('booking', compact('products', 'services'));
})->name('booking');
Route::view('/contact', 'contact')->name('contact');
Route::view('/consult', 'pages.consult')->name('consult');

// Public Testimonial Routes
Route::get('/testimonial', [PublicTestimonialController::class, 'create'])->name('send.testimonial');
Route::post('/testimonial', [PublicTestimonialController::class, 'store'])->name('testimonial.store');

// ✅ FAQ & Help Pages
Route::view('/faq', 'pages.help.faq')->name('faq');
Route::view('/syaratketentuan', 'pages.help.syaratketentuan')->name('syaratketentuan');
Route::view('/kontak', 'pages.help.kontak')->name('kontak');


// ==================== 🛍️ PRODUK ====================

// List Produk
Route::get('/products', function () {
    $items = Product::latest()->get();
    return view('pages.products.products', compact('items'));
})->name('products');

// Detail Produk
Route::get('/products/{slug}', function ($slug) {
    $product = Product::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();
    $recommended_products = Product::where('id', '!=', $product->id)->latest()->take(4)->get();

    return view('pages.products.show', compact('product', 'recommended_products'));
})->name('product.show');


// ==================== 🧸 LAYANAN ====================

// List Layanan
Route::get('/services', function () {
    $items = Service::latest()->get();
    return view('pages.services.services', compact('items'));
})->name('services');

// Detail Layanan
Route::get('/services/{slug}', function ($slug) {
    $service = Service::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();
    $recommended_services = Service::where('id', '!=', $service->id)->latest()->take(4)->get();

    return view('pages.services.show', compact('service', 'recommended_services'));
})->name('service.show');


// ==================== 🖼️ GALERI ====================

// List Galeri
Route::get('/gallery', function () {
    $galleries = Gallery::latest()->get();
    return view('pages.gallery.gallery', compact('galleries'));
})->name('gallery.index');


// ==================== 🔐 ADMIN AUTH ====================

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');


// ==================== ⚙️ ADMIN CMS ====================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('home', HomeController::class);
    Route::resource('abouts', AboutController::class); // ✅ sudah termasuk show
    Route::resource('products', ProductController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('testimonials', TestimonialController::class);
});


// ==================== 🗂️ PUBLIC STORAGE ====================

Route::get('storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
})->where('path', '.*')->name('storage.local');
