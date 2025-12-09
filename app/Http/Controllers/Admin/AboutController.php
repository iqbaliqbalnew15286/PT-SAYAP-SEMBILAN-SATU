<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return view('admin.tables.abouts.index', compact('abouts'));
    }

    public function create()
    {
        // Cegah membuat lebih dari 1 data
        if (About::count() >= 1) {
            return redirect()->route('admin.abouts.index')
                ->with('error', 'Data sudah ada, tidak bisa tambah lagi.');
        }

        return view('admin.tables.abouts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vision' => 'required|string',
            'mission' => 'required|string',
            'goal' => 'required|string',
            'image' => 'nullable|image|max:4096'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/about', 'public');
        }

        About::create($data);

        return redirect()->route('admin.abouts.index')
            ->with('success', 'Data berhasil ditambahkan!');
    }

    public function show(About $about)
    {
        return view('admin.tables.abouts.show', compact('about'));
    }

    public function edit(About $about)
    {
        return view('admin.tables.abouts.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $data = $request->validate([
            'vision' => 'required|string',
            'mission' => 'required|string',
            'goal' => 'required|string',
            'image' => 'nullable|image|max:4096'
        ]);

        if ($request->hasFile('image')) {
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }
            $data['image'] = $request->file('image')->store('uploads/about', 'public');
        }

        $about->update($data);

        return redirect()->route('admin.abouts.index')
            ->with('success','Data berhasil diperbarui!');
    }

    public function destroy(About $about)
    {
        if ($about->image && Storage::disk('public')->exists($about->image)) {
            Storage::disk('public')->delete($about->image);
        }

        $about->delete();

        return redirect()->route('admin.abouts.index')
            ->with('success','Data berhasil dihapus!');
    }
}
