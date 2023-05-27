<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'deposit',
        'code',
        'start_at',
        'end_at',
        'total',
        'status',
        'note',
        'user_id',
        'football_pitch_id',
    ];

    public function footballPitch()
    {
        return $this->belongsTo(FootballPitch::class, 'football_pitch_id');
    }

    public function total()
    {
        return printMoney($this->total);
    }

    public function deposit()
    {
        return printMoney($this->deposit);
    }

    public function finalTotal()
    {
        return printMoney($this->total - $this->deposit);
    }

    public function totalTime()
    {
        $start_at = new Carbon($this->start_at);
        $end_at = new Carbon($this->end_at);
        $h = (int)($start_at->diffInMinutes($end_at) / 60);
        $m = $start_at->diffInMinutes($end_at) % 60;
        $totalTime = "$h giờ $m phút";
        return $totalTime;
    }
}
