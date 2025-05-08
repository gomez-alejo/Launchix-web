<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de inicio de sesión.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        // Retorna la vista del formulario de inicio de sesión
        return view('login'); // Asegúrate de que esta vista exista
    }

    /**
     * Autentica al usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Obtiene las credenciales del formulario
        $credentials = $request->only('email', 'password');

        // Intenta autenticar al usuario con las credenciales proporcionadas
        if (Auth::attempt($credentials)) {
            // Autenticación exitosa, redirige al usuario a la página de perfil
            return redirect()->intended('usuario');
        }

        // Si la autenticación falla, redirige de vuelta con un mensaje de error
        return redirect()->back()->withErrors(['email' => 'Las credenciales no coinciden con nuestros registros.'])->withInput($request->only('email'));
    }

    /**
     * Cierra la sesión del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Cierra la sesión del usuario
        Auth::logout();
        // Invalida la sesión actual
        $request->session()->invalidate();
        // Regenera el token de sesión
        $request->session()->regenerateToken();
        // Redirige al usuario a la página de inicio de sesión
        return redirect('/login');
    }
}
