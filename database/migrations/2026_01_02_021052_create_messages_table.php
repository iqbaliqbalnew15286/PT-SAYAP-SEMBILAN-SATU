<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users
            $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');

            // Isi pesan
            $table->text('message');

            // Tipe pengirim (admin/user)
            $table->enum('sender_type', ['admin', 'user'])->default('user');

            // Informasi tambahan
            $table->string('device_info')->nullable();
            $table->boolean('is_read')->default(false);

            $table->timestamps();

            // Indexing untuk mempercepat query history chat antara 2 orang
            $table->index(['sender_id', 'receiver_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};
