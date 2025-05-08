<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Muestra el formulario de registro.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('registro');
    }

    /**
     * Registra un nuevo usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validar los datos de entrada del usuario
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|string|max:255',  // Nombre es obligatorio, debe ser una cadena y máximo 255 caracteres
            'lastName' => 'required|string|max:255',   // Apellido es obligatorio, debe ser una cadena y máximo 255 caracteres
            'username' => 'required|string|max:255|unique:users', // Nombre de usuario es obligatorio, debe ser una cadena, máximo 255 caracteres y único en la tabla users
            'email' => 'required|string|email|max:255|unique:users', // Correo electrónico es obligatorio, debe ser una cadena, formato de correo válido, máximo 255 caracteres y único en la tabla users
            'password' => 'required|string|min:8|confirmed', // Contraseña es obligatoria, debe ser una cadena, mínimo 8 caracteres y debe coincidir con la confirmación de contraseña
        ]);

        // Si la validación falla, redirigir con errores y datos de entrada
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        // Crear un nuevo usuario con los datos validados
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encriptar la contraseña antes de guardarla
        ]);

        // Redirigir al usuario a la página de inicio de sesión con un mensaje de éxito
        return redirect()->route('login')->with('success', 'Usuario registrado exitosamente.');
    }
}
