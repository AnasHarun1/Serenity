<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capsule extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'scheduled_at', 'is_read'];

    // Casting agar 'scheduled_at' dibaca sebagai Carbon Date (bisa diformat)
    protected $casts = [
        'scheduled_at' => 'date',
    ];
}