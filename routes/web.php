<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\PublicTestimonialController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\About;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda. Rute-rute
| ini dimuat oleh RouteServiceProvider dalam grup yang berisi middleware
| 'web'. Sekarang buatlah sesuatu yang hebat!
|
*/

// ==================== FRONTEND / PUBLIC ====================

// Home Page
Route::get('/', function () {
    $products = Product::latest()->take(4)->get();
    // $services = Service::latest()->take(4)->get(); // DIHAPUS
    $testimonials = Testimonial::latest()->take(3)->get();
    $galleryItems = Gallery::latest()->take(4)->get();
    $partners = \App\Models\Partner::latest()->get();
    $facilities = \App\Models\Facility::latest()->take(5)->get();

    // Placeholder variables
    $latestNews = collect();
    $mainImages = collect();
    $gridImages = collect();
    $majors = collect();
    $majorGridImages = collect();

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
        'testimonials',
        'galleryItems',
        'partners',
        'facilities',
        'latestNews',
        'mainImages',
        'gridImages',
        'majors',
        'majorGridImages',
        'advantages'
    ));
})->name('home');

// Search Route
Route::get('/search', function (Request $request) {
    $query = $request->get('query');

    if (!$query) {
        return redirect()->back()->with('error', 'Silakan masukkan kata kunci pencarian.');
    }

    // Hanya mencari di Produk (menggantikan Produk dan Layanan)
    $products = Product::where('name', 'like', '%' . $query . '%')
        ->orWhere('description', 'like', '%' . $query . '%')
        ->get();

    // Mengubah view: tidak lagi mengirim 'services'
    return view('pages.search.results', compact('products', 'query'));
})->name('search');


// Dynamic About (Visi, Misi, Tujuan dari CMS)
Route::get('/about', function () {
    $about = About::first();
    return view('pages.about', compact('about'));
})->name('about');


// Static Pages
Route::get('/booking', function () {
    $products = \App\Models\Product::latest()->get();
    // Menghapus variabel 'services' dari compact
    return view('booking', compact('products'));
})->name('booking');

Route::view('/contact', 'contact')->name('contact');
Route::view('/consult', 'pages.consult')->name('consult');

// Public Testimonial Routes
Route::get('/testimonial', [PublicTestimonialController::class, 'create'])->name('send.testimonial');
Route::post('/testimonial', [PublicTestimonialController::class, 'store'])->name('testimonial.store');

// FAQ & Help Pages
Route::view('/faq', 'pages.help.faq')->name('faq');
Route::view('/syaratketentuan', 'pages.help.syaratketentuan')->name('syaratketentuan');
Route::view('/kontak', 'pages.help.kontak')->name('kontak');


// ==================== PRODUK (BARANG & JASA) ====================

// List Produk (Sekarang mencakup barang dan jasa)
Route::get('/products', function () {
    $items = Product::latest()->get();
    return view('pages.products.products', compact('items'));
})->name('products');

// Detail Produk (Menggunakan slug)
Route::get('/products/{slug}', function ($slug) {
    // Mencari berdasarkan slug, fallback ke id jika diperlukan
    $product = Product::where('slug', $slug)->orWhere('id', $slug)->firstOrFail();

    // Mengambil produk rekomendasi, tidak termasuk produk saat ini
    $recommended_products = Product::where('id', '!=', $product->id)->latest()->take(4)->get();

    return view('pages.products.show', compact('product', 'recommended_products'));
})->name('product.show');

// ==================== GALERI ====================

// List Galeri
Route::get('/gallery', function () {
    $galleries = Gallery::latest()->get();
    return view('pages.gallery.gallery', compact('galleries'));
})->name('gallery.index');


// ==================== PARTNERS ====================

// List Partners
Route::get('/partners', function () {
    $partners = \App\Models\Partner::latest()->get();
    return view('pages.partners.index', compact('partners'));
})->name('partners');

// Detail Partner
Route::get('/partners/{id}', function ($id) {
    $partner = \App\Models\Partner::findOrFail($id);
    return view('pages.partners.show', compact('partner'));
})->name('partners.show');


// ==================== FACILITIES ====================

// List Facilities
Route::get('/facilities', function () {
    $facilities = \App\Models\Facility::latest()->get();
    $groupedFacilities = $facilities->groupBy('type');
    $facilityImages = collect(); // Placeholder
    $gridImages = collect(); // Placeholder
    return view('pages.facilities.index', compact('facilities', 'groupedFacilities', 'facilityImages', 'gridImages'));
})->name('facilities');

// Detail Facility
Route::get('/facilities/{id}', function ($id) {
    $facility = \App\Models\Facility::findOrFail($id);
    return view('pages.facilities.show', compact('facility'));
})->name('facilities.show');


// ==================== ADMIN AUTH ====================

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');


// ==================== ADMIN CMS ====================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('home', AdminHomeController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('products', ProductController::class);
    // Route::resource('services', ServiceController::class); // DIHAPUS
    Route::resource('galleries', GalleryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
    Route::resource('facilities', \App\Http\Controllers\Admin\FacilityController::class);
});


// ==================== PUBLIC STORAGE ====================

// Rute ini penting untuk mengakses file yang diunggah dari storage/app/public
Route::get('storage/{path}', function ($path) {
    // Menggunakan symlink storage:link adalah cara yang lebih disarankan,
    // tetapi jika tidak, rute ini dapat berfungsi sebagai fallback.
    $storagePath = storage_path('app/public/' . $path);

    if (!Storage::disk('public')->exists($path)) {
        abort(404);
    }

    // Mengembalikan file dengan header yang tepat
    return response()->file($storagePath);
})->where('path', '.*')->name('storage.local');
