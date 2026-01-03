<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     * (Opsional, jika nama tabel Anda adalah 'bookings')
     */
    protected $table = 'bookings';

    /**
     * Atribut yang dapat diisi secara massal.
     */
    protected $fillable = [
        'user_id',
        'services',
        'date',
        'time',
        'total_price',
        'note',
        'status',
        'admin_note',
    ];

    /**
     * Atribut yang harus dikonversi ke tipe data tertentu.
     * Ini memastikan 'date' selalu menjadi objek Carbon agar bisa diformat
     * di Blade dengan ->translatedFormat('d M Y').
     */
    protected $casts = [
        'date' => 'date',
        'total_price' => 'integer',
    ];

    /**
     * Relasi: Satu booking dimiliki oleh satu User (Pelanggan).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope untuk mempermudah filter berdasarkan status (Opsional)
     * Contoh penggunaan: Booking::status('pending')->get();
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
