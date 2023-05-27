<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PitchType extends Model
{
    use HasFactory;
    protected $fillable = [
        'quantity',
        'description',
    ];
}
