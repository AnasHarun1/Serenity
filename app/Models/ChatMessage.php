<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    // Izinkan kolom-kolom ini diisi
    protected $fillable = ['user_id', 'message', 'is_user'];
}
