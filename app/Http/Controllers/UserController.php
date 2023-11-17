<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(UserStoreRequest $request){
        User::create([
            'name'=>$request->name,
            'lastname'=>$request->lastname,
            'rol_id'=>$request->rol,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return redirect()->back()->with('status','Usuario creado correctamente.');
    }
    public function destroy($id){
        User::destroy($id);
        return redirect()->back()->with('status','Usuario eliminado correctamente.');
    }
}
