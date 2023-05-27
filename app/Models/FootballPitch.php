<?php

namespace App\Models;

use App\Enums\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballPitch extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'time_start',
        'time_end',
        'description',
        'price_per_hour',
        'price_per_peak_hour',
        'is_maintenance',
        'pitch_type_id',
        'from_football_pitch_id',
        'to_football_pitch_id',
    ];

    public function pitchType()
    {
        return $this->belongsTo(PitchType::class, 'pitch_type_id');
    }

    public function fromFootballPitch()
    {
        return $this->belongsTo(FootballPitch::class, 'from_football_pitch_id');
    }

    public function toFootballPitch()
    {
        return $this->belongsTo(FootballPitch::class, 'to_football_pitch_id');
    }

    public function timeStart()
    {
        return timeForHumans($this->time_start);
    }

    public function createdAt()
    {
        return $this->created_at->diffForHumans();
    }

    public function timeEnd()
    {
        return timeForHumans($this->time_end);
    }

    public function pricePerHour()
    {
        return printMoney($this->price_per_hour);
    }

    public function pricePerPeakHour()
    {
        return printMoney($this->price_per_peak_hour);
    }

    public function nameFootBallPitchLink()
    {
        return $this->from_football_pitch_id ? ($this->fromFootballPitch->name . ' - ' . $this->toFootballPitch->name) : '';
    }

    public function images()
    {
        return $this->hasMany(FootballPitchDetail::class, 'football_pitch_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'football_pitch_id', 'id');
    }

    public function countOrderSuccess()
    {
        return $this->orders->where('status','>=' , OrderStatusEnum::Finish)->count();
    }
}
