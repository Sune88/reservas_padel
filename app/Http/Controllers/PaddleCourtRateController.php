<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaddleCourtRateRequest;
use App\Models\ValorationsCourt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaddleCourtRateController extends Controller
{
    public function store(PaddleCourtRateRequest $request){
        ValorationsCourt::create([
            "paddle_court_id"=>$request->paddle_court_id,
            "user_id"=>Auth::id(),
            "comment"=>$request->text,
            "rate"=>$request->rate,
        ]);
        return response()->json(['message'=>"Valoración enviada correctamente."]);
    }
}
