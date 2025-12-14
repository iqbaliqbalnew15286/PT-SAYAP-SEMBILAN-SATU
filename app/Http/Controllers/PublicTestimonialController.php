<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class PublicTestimonialController extends Controller
{
    /**
     * Store a new testimonial from public form.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // For public submissions, set status or something, but since no status, just create
        Testimonial::create($data);

        return back()->with('success', 'Terima kasih! Testimoni Anda telah dikirim dan akan ditinjau oleh admin sebelum ditampilkan.');
    }

    /**
     * Show the testimonial form page (if needed).
     */
    public function create()
    {
        return view('pages.testimonial.create'); // if needed
    }
}
