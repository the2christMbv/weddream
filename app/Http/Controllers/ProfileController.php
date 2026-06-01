<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit() {
        return view('profile.edit');
    }

    public function update(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Vérifier si l'ancien mot de passe est correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Le mot de passe actuel est incorrect.']);
        }

        // Mise à jour
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('success', 'Votre mot de passe a été modifié !');
    }
}