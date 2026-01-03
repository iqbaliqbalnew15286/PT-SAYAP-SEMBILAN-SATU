<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Menampilkan daftar semua booking (Halaman Index).
     */
    public function index()
    {
        // Ambil data terbaru dengan relasi user
        $reservations = Reservation::with('user')->latest()->paginate(10);

        // Arahkan ke folder resources/views/admin/booking/index.blade.php
        return view('admin.booking.index', compact('reservations'));
    }

    /**
     * Memperbarui Status & Harga
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,batal',
            'total_price' => 'nullable|numeric|min:0',
        ]);

        try {
            $reservation = Reservation::findOrFail($id);

            $reservation->update([
                'status' => $request->status,
                // Gunakan request->filled agar jika input kosong tidak menimpa harga lama
                'total_price' => $request->filled('total_price') ? $request->total_price : $reservation->total_price,
            ]);

            return redirect()->back()
                ->with('success', "Status Booking #{$id} berhasil diperbarui!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }

    /**
     * Menghapus data booking.
     */
    public function destroy($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();

            // SINKRONKAN: Jika di web.php namanya admin.booking.index
            return redirect()->route('admin.booking.index')
                ->with('success', 'Data booking berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data.');
        }
    }

    /**
     * Logika Chat Booking (Halaman Pesan)
     */
    public function chat($id)
    {
        // Konteks: Admin ingin chat spesifik tentang reservasi ini
        $reservation = Reservation::with('user')->findOrFail($id);

        // Mengarahkan ke resources/views/admin/booking/chat.blade.php
        return view('admin.booking.chat', compact('reservation'));
    }
}
