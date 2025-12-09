<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            // Data dasar dari pemesan
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();

            // Relasi ke tabel services (bisa kosong jika belum dipilih)
            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->nullOnDelete();

            // Informasi waktu reservasi
            $table->date('date')->nullable();
            $table->time('time')->nullable();

            // Catatan tambahan dari pengguna
            $table->text('note')->nullable();

            // Status reservasi (pending, accepted, done)
            $table->string('status')->default('pending');

            // Timestamp created_at dan updated_at
            $table->timestamps();
        });
    }

    /**
     * Hapus tabel saat rollback.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
