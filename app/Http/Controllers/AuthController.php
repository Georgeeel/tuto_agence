<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        // creation utilisateur
        // User::create([
        //     'name' => 'Marc',
        //     'email' => 'marc@yahoo.com',
        //     'password' => Hash::make('1111')
        // ]);
        return view('auth.login');
    }

    public function doLogin(LoginRequest $request)
    {
        $credentials = $request->validated();
        // si l'admin est connecté
        if(Auth::attempt($credentials)){
            // regenerer l'id pour la securité
            $request->session()->regenerate();
            return redirect()->intended(route('admin.property.index'));
        }
        // rediriger avec error
        return back()->withErrors([
            'email' => 'Identifiant incorrect'
        ])->onlyInput('email');
    }
    
    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success', 'Vous êtes maintenant déconnecté');
    }
}
