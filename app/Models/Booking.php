<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = "bookings";
    protected $fillable = [
        "user_id","paddle_court_id","booking_state_id",
        "hour_start","hour_end","date","paid","total_amount","payment_id"
    ];

    public function state(){
        return $this->belongsTo(BookingState::class,"booking_state_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function paddle_court(){
        return $this->belongsTo(PaddleCourt::class,"paddle_court_id","id");
    }
}
