<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeakHour extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_at',
    ];
}
