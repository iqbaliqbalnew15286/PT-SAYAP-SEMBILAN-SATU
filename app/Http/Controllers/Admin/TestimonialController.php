<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    /**
     * Tampilkan semua testimoni.
     */
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.tables.testimonials.index', compact('testimonials'));
    }

    /**
     * Form tambah testimoni baru.
     */
    public function create()
    {
        return view('admin.tables.testimonials.create');
    }

    /**
     * Simpan testimoni baru ke database.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Simpan foto jika ada upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/testimonials', 'public');
        }

        Testimonial::create($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan!');
    }

    /**
     * Form edit testimoni.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.tables.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update testimoni.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:1000',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Jika ada upload foto baru, hapus foto lama lalu simpan yang baru
        if ($request->hasFile('photo')) {
            if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
                Storage::disk('public')->delete($testimonial->photo);
            }

            $data['photo'] = $request->file('photo')->store('uploads/testimonials', 'public');
        }

        $testimonial->update($data);

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui!');
    }

    /**
     * Hapus testimoni.
     */
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo && Storage::disk('public')->exists($testimonial->photo)) {
            Storage::disk('public')->delete($testimonial->photo);
        }

        $testimonial->delete();

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus!');
    }

    /**
     * Lihat detail testimoni.
     */
    public function show(Testimonial $testimonial)
    {
        return view('admin.tables.testimonials.show', compact('testimonial'));
    }
}
