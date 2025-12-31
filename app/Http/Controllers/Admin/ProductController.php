<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str; // 🛑 PENTING: Import Facade Str untuk membuat slug
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk dengan opsi filter (barang/jasa) dan pagination.
     */
    public function index(Request $request)
    {
        $filterType = $request->input('type');
        $query = Product::latest();

        if ($filterType && in_array($filterType, ['barang', 'jasa'])) {
            $query->where('type', $filterType);
        }

        $products = $query->paginate(10);

        return view('admin.tables.products.index', compact('products', 'filterType'));
    }

    /**
     * Menampilkan formulir pembuatan produk baru.
     */
    public function create()
    {
        return view('admin.tables.products.create');
    }

    /**
     * Metode Penyimpanan Data Produk (Barang atau Jasa).
     */
    public function store(Request $request)
    {
        // 1. Tentukan Validasi Bersyarat
        $rules = [
            'type' => ['required', 'in:barang,jasa'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ];

        // 2. Tambahkan Validasi Gambar Berdasarkan Tipe Produk
        $rules['image'] = [
            $request->input('type') === 'barang' ? 'required' : 'nullable',
            'image',
            'max:4096' // 4MB
        ];

        $validated = $request->validate($rules);

        // 🛑 3. PENANGANAN SLUG (STORE)
        $slug = Str::slug($validated['name']);

        // Cek apakah slug sudah ada di database
        if (Product::where('slug', $slug)->exists()) {
            // Jika duplikat, tambahkan timestamp untuk memastikan keunikan
            $validated['slug'] = $slug . '-' . time();
        } else {
            $validated['slug'] = $slug;
        }

        // 4. Proses Upload Gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/products', 'public');
        }

        // 5. Gabungkan path gambar ke data validasi
        $validated['image'] = $imagePath;

        // 6. Simpan ke Database
        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', '✅ Produk berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail produk tertentu.
     */
    public function show(Product $product)
    {
        return view('admin.tables.products.show', compact('product'));
    }

    /**
     * Menampilkan formulir pengeditan produk.
     */
    public function edit(Product $product)
    {
        return view('admin.tables.products.edit', compact('product'));
    }

    /**
     * Metode Pembaruan Data Produk.
     */
    public function update(Request $request, Product $product)
    {
        // 1. Tentukan Validasi
        $rules = [
            'type' => ['required', 'in:barang,jasa'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ];

        $validated = $request->validate($rules);

        // 🛑 2. PENANGANAN SLUG (UPDATE)
        // Hanya buat ulang slug jika 'name' diubah
        if ($validated['name'] !== $product->name) {
            $slug = Str::slug($validated['name']);

            // Cek apakah slug sudah ada, tetapi tidak termasuk slug produk saat ini
            if (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
                $validated['slug'] = $slug . '-' . time();
            } else {
                $validated['slug'] = $slug;
            }
        } else {
            // Jika nama tidak berubah, gunakan slug yang sudah ada
            $validated['slug'] = $product->slug;
        }

        // 3. Proses Upload Gambar (Baru)
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            // Upload gambar baru
            $validated['image'] = $request->file('image')->store('uploads/products', 'public');
        }

        // 4. Update data
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', '✅ Produk berhasil diperbarui!');
    }

    /**
     * Metode Penghapusan Produk.
     */
    public function destroy(Product $product)
    {
        // Hapus file gambar dari storage sebelum menghapus record
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', '🗑️ Produk berhasil dihapus!');
    }
}
