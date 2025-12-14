<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    $partners = \App\Models\Partner::latest()->get();
    $facilities = \App\Models\Facility::latest()->take(5)->get();

    // Additional variables for the view
    $latestNews = collect(); // Placeholder, add News model if exists
    $mainImages = collect(); // Placeholder
    $gridImages = collect(); // Placeholder
    $majors = collect(); // Placeholder
    $majorGridImages = collect(); // Placeholder

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
        return redirect()->back()->with('error', 'Please enter a search term.');
    }

    $products = Product::where('name', 'like', '%' . $query . '%')
        ->orWhere('description', 'like', '%' . $query . '%')
        ->get();

    $services = Service::where('name', 'like', '%' . $query . '%')
        ->orWhere('description', 'like', '%' . $query . '%')
        ->get();

    return view('pages.search.results', compact('products', 'services', 'query'));
})->name('search');


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


// ==================== 🤝 PARTNERS ====================

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


// ==================== 🏢 FACILITIES ====================

// List Facilities
Route::get('/facilities', function () {
    $facilities = \App\Models\Facility::latest()->get();
    $groupedFacilities = $facilities->groupBy('type');
    $facilityImages = collect(); // Placeholder, add FacilityImage model if exists
    $gridImages = collect(); // Placeholder
    return view('pages.facilities.index', compact('facilities', 'groupedFacilities', 'facilityImages', 'gridImages'));
})->name('facilities');

// Detail Facility
Route::get('/facilities/{id}', function ($id) {
    $facility = \App\Models\Facility::findOrFail($id);
    return view('pages.facilities.show', compact('facility'));
})->name('facilities.show');


// ==================== 🔐 ADMIN AUTH ====================

Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');


// ==================== ⚙️ ADMIN CMS ====================

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('home', AdminHomeController::class);
    Route::resource('abouts', AboutController::class); // ✅ sudah termasuk show
    Route::resource('products', ProductController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('partners', \App\Http\Controllers\Admin\PartnerController::class);
    Route::resource('facilities', \App\Http\Controllers\Admin\FacilityController::class);
});


// ==================== 🗂️ PUBLIC STORAGE ====================

Route::get('storage/{path}', function ($path) {
    return response()->file(storage_path('app/public/' . $path));
})->where('path', '.*')->name('storage.local');
