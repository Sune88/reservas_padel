<?php

namespace App\Http\Controllers;

use App\Models\PaddleCourt;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $paddle_courts = PaddleCourt::limit(3)->get();
        return view('home',compact('paddle_courts'));
    }
}
