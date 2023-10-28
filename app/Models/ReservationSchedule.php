<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationSchedule extends Model
{
    use HasFactory;
    protected $table = "reservation_schedules";
    protected $fillable = ["paddle_court_id","hour_bookable"];

    public function paddle_court(){
        return $this->belongsTo(PaddleCourt::class,"paddle_court_id","id");
    }
}
