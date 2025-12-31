<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class GalleryController extends Controller
{
    /**
     * Menampilkan daftar semua gambar di galeri.
     */
    public function index()
    {
        $galleries = Gallery::latest()->get();
        // Pastikan path view sesuai dengan struktur proyek Anda
        return view('admin.tables.galleries.index', compact('galleries'));
    }

    /**
     * Menampilkan formulir untuk menambah gambar baru.
     */
    public function create()
    {
        // Pastikan path view sesuai dengan struktur proyek Anda
        return view('admin.tables.galleries.create');
    }

    /**
     * Menyimpan gambar baru ke database dan storage.
     */
    public function store(Request $request)
    {
        // Validasi HANYA untuk 'image'
        $data = $request->validate([
            'image' => 'required|image|max:4096', // Wajib ada saat membuat
        ]);

        // Proses penyimpanan file
        $data['image'] = $request->file('image')->store('uploads/gallery', 'public');

        // Ciptakan entri baru hanya dengan data gambar
        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gambar berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail gambar (pratinjau).
     * Kami asumsikan Anda memiliki view show.blade.php
     */
    public function show(Gallery $gallery)
    {
        // Pastikan path view sesuai dengan struktur proyek Anda
        return view('admin.tables.galleries.show', compact('gallery'));
    }

    /**
     * Menampilkan formulir untuk mengedit gambar.
     */
    public function edit(Gallery $gallery)
    {
        // Pastikan path view sesuai dengan struktur proyek Anda
        return view('admin.tables.galleries.edit', compact('gallery'));
    }

    /**
     * Memperbarui gambar yang sudah ada.
     */
    public function update(Request $request, Gallery $gallery)
    {
        // Validasi HANYA untuk 'image' (nullable karena boleh tidak diisi saat update)
        $data = $request->validate([
            'image' => 'nullable|image|max:4096',
        ]);

        // Cek apakah ada file baru diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama (jika ada)
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            // Simpan gambar baru
            $data['image'] = $request->file('image')->store('uploads/gallery', 'public');
        } else {
            // Jika tidak ada file baru di-upload, pastikan kolom 'image' tidak masuk ke update
            unset($data['image']);
        }

        // Catatan: Karena kolom title dan description dihapus dari validasi,
        // $data hanya berisi 'image' (jika diupload)
        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Gambar galeri berhasil diperbarui!');
    }

    /**
     * Menghapus gambar dari database dan storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Hapus file dari storage sebelum menghapus dari database
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();
        return redirect()->route('admin.galleries.index')->with('success', 'Gambar berhasil dihapus!');
    }
}
