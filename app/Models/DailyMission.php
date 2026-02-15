<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyMission extends Model
{
    protected $fillable = ['user_id', 'mission_text', 'mission_date', 'is_completed'];
}