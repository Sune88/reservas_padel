<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\PaddleCourt;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $paddle_courts = PaddleCourt::limit(3)->get();
        return view('home',compact('paddle_courts'));
    }
    public function rules(){
        return view('padel_rules');
    }
    public function admin(){
        $users = User::all();
        $bookings = Booking::all();
        $paddleCourts = PaddleCourt::all();
        $contacts = Contact::all();
        return view('admin.admin_dashboard',compact('users','bookings','paddleCourts','contacts'));
    }

}
