<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ReservationController extends Controller
{
    /**
     * Menampilkan daftar semua booking (dengan pagination).
     */
    public function index()
    {
        // Menggunakan latest() agar data terbaru muncul di paling atas
        $reservations = Reservation::latest()->paginate(10);

        // Sesuaikan path view ini dengan folder tempat Anda menyimpan file .blade.php
        return view('admin.tables.booking.index', compact('reservations'));
    }

    /**
     * Menampilkan detail lengkap satu data booking.
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.tables.booking.show', compact('reservation'));
    }

    /**
     * Menampilkan form edit status dan harga.
     */
    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('admin.tables.booking.edit', compact('reservation'));
    }

    /**
     * Memperbarui data ke database.
     */
    public function update(Request $request, $id)
    {
        // Tambahkan validasi untuk total_price agar input harus berupa angka
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,batal',
            'total_price' => 'nullable|numeric|min:0',
        ]);

        $reservation = Reservation::findOrFail($id);

        $reservation->update([
            'status' => $request->status,
            'total_price' => $request->total_price ?? $reservation->total_price,
        ]);

        return redirect()->route('admin.booking.index')
            ->with('success', 'Reservasi #' . $id . ' berhasil diperbarui.');
    }

    /**
     * Menghapus data booking secara permanen.
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();

        return redirect()->route('admin.booking.index')
            ->with('success', 'Data booking berhasil dihapus dari sistem.');
    }
}
