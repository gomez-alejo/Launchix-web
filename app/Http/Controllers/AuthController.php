<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // Asegúrate de que esta vista exista
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Autenticación exitosa
            return redirect()->intended('usuario');
        }
    
        return redirect()->back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.'])->withInput($request->only('email'));
    }
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
