<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'status'
    ];

    protected $casts = [
        'status' => 'string',
    ];
}
