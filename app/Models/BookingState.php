<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingState extends Model
{
    use HasFactory;
    protected $table = "booking_states";
    protected $fillable = [
        'name',
    ];


}
