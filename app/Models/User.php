<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atribut yang bisa diisi (Mass Assignable).
     * Saya tambahkan 'phone' agar sesuai dengan form registrasi kamu.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
    ];

    /**
     * Atribut yang disembunyikan.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casting atribut.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * CUSTOM NOTIFIKASI RESET PASSWORD
     * Method ini akan otomatis terpanggil saat user meminta reset password.
     */
    public function sendPasswordResetNotification($token)
    {
        // URL tujuan yang dikirim ke email
        $url = route('password.reset', [
            'token' => $token,
            'email' => $this->email,
        ]);

        // Mengirim Email dengan tampilan kustom
        $this->notify(new class($url) extends ResetPasswordNotification {
            protected $resetUrl;

            public function __construct($url)
            {
                $this->resetUrl = $url;
            }

            public function toMail($notifiable)
            {
                return (new MailMessage)
                    ->subject('Atur Ulang Password - Tower Booking')
                    ->greeting('Halo, ' . $notifiable->name . '!')
                    ->line('Kami menerima permintaan untuk mengatur ulang password akun Anda di Booking Tower Management.')
                    ->action('Atur Ulang Password Sekarang', $this->resetUrl)
                    ->line('Link reset password ini akan kadaluarsa dalam 60 menit.')
                    ->line('Jika Anda tidak merasa meminta ini, abaikan saja email ini.')
                    ->salutation('Salam hangat, ' . config('app.name'));
            }
        });
    }
}
