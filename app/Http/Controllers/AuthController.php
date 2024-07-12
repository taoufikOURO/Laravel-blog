<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //register user
    public function register(Request $request) {
        //Valider les données
        $fields = $request->validate([
            "username" => ['required', 'max:255', 'min:3'],
            "email" => ['required', 'max:255', 'email', 'unique:users'],
            "password" => ['required', 'min:3', 'confirmed']
        ]);

        //Création du compte
        $user = User::create($fields);

        //Connexion
        Auth::login($user);

        //Redirection
        return redirect()->route('dashboard');
    }

    
    //login user
    public function login(Request $request) {
        //Valider les données
        $fields = $request->validate([
            "email" => ['required', 'max:255', 'email'],
            "password" => ['required']
        ]);
        
        //try to login

        if(Auth::attempt($fields, $request->remember))
        {
            return redirect()->route('dashboard');
        }else{
            return back()->withErrors([
                'failed' => 'Email ou mot de passe incorrect'
            ]);
        }

        dd($request);
    }

    //logout
    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
