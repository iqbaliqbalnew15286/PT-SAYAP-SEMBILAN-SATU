<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'phone'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi Reservasi
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Relasi Pesan sebagai Pengirim
    public function messagesAsSender()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Relasi Pesan sebagai Penerima
    public function messagesAsReceiver()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    // Mengambil pesan terakhir secara spesifik antara User ini dan Admin login
    public function latestMessageWithAdmin()
    {
        return Message::where(function($q) {
            $q->where('sender_id', $this->id)->where('receiver_id', auth()->id());
        })->orWhere(function($q) {
            $q->where('sender_id', auth()->id())->where('receiver_id', $this->id);
        })->latest()->first();
    }
}
