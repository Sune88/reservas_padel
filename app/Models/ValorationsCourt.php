<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValorationsCourt extends Model
{
    use HasFactory;
    protected $table = "valorations_courts";
    protected $fillable = ["paddle_court_id","user_id","comment","rate"];

    public function paddle_court(){
        return $this->belongsTo(PaddleCourt::class,"paddle_court_id","id");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id","id");
    }
}
