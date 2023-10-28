<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaddleCourt extends Model
{
    use HasFactory;
    protected $table = "paddle_courts";
    protected $fillable = ["name","description","image","price"];

    public function resrvation_schedules(){
        return $this->hasMany(ReservationSchedule::class, "paddle_court_id");
    }
    public function comments(){
        return $this->hasMany(ValorationsCourt::class,"paddle_court_id");
    }
}
