<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
            'bookings' => $request->user()->bookings,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        if ($request->avatar) {
            $nombreArchivo = Auth::id().time(). $request->file('avatar')->extension();
            $rutaAvatar = $request->file('avatar')->storeAs('avatar', $nombreArchivo, 'public');
            Auth::user()->avatar = $rutaAvatar;
        }
        if($request->password){
            Auth::user()->password=$request->password;
        }

        Auth::user()->name=$request->name;
        Auth::user()->lastname=$request->lastname;
        Auth::user()->email=$request->email;
        Auth::user()->save();

        return Redirect::route('profile.edit')->with('status', 'Perfil actualizado correctamente.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
