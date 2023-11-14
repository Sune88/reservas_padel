<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index(){
        return view('contact.contact');
    }
    public function send(ContactRequest $request){

        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ]);
        return Redirect::route('contact.index')->with('status','Mensaje enviado correctamente.');
    }
}
