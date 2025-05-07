<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Muestra el perfil del usuario autenticado
    public function showProfile()
    {
        $user = Auth::user(); // Obtiene el usuario autenticado
        return view('usuario', compact('user')); // Retorna la vista 'usuario' con los datos del usuario
    }

    // Actualiza el perfil del usuario
    public function updateProfile(Request $request)
    {
        $user = Auth::user(); // Obtiene el usuario autenticado

        if (!$user) {
            return redirect()->route('login')->with('error', 'Usuario no autenticado.'); // Redirige si el usuario no está autenticado
        }

        // Valida los datos de entrada para el perfil
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'userDescription' => 'nullable|string|max:500',
        ]);

        try {
            // Actualiza los datos del perfil del usuario
            $user->username = $validatedData['username'];
            $user->description = $validatedData['userDescription'];
             /** @var \App\Models\User $user */
            $user->save(); // Guarda los cambios en la base de datos

            return redirect()->route('usuario')->with('success', 'Perfil actualizado exitosamente.'); // Redirige con mensaje de éxito
        } catch (\Exception $e) {
            return redirect()->route('usuario')->with('error', 'Ocurrió un error al actualizar el perfil: ' . $e->getMessage()); // Manejo de errores
        }
    }

    // Actualiza los datos del usuario
    public function updateUserData(Request $request)
    {
        $user = Auth::user(); // Obtiene el usuario autenticado

        if (!$user) {
            return redirect()->route('login')->with('error', 'Usuario no autenticado.'); // Redirige si el usuario no está autenticado
        }

        // Valida los datos de entrada para la actualización del usuario
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Verifica la contraseña actual
            if (!Hash::check($validatedData['current_password'], $user->password)) {
                return redirect()->route('usuario')->with('error', 'La contraseña actual es incorrecta.'); // Error si la contraseña es incorrecta
            }

            // Actualiza los datos del usuario
            $user->firstName = $validatedData['firstName'];
            $user->lastName = $validatedData['lastName'];
            $user->email = $validatedData['email'];
            $user->password = Hash::make($validatedData['new_password']); // Encripta la nueva contraseña
             /** @var \App\Models\User $user */
            $user->save(); // Guarda los cambios en la base de datos

            return redirect()->route('usuario')->with('success', 'Datos de usuario actualizados exitosamente.'); // Redirige con mensaje de éxito
        } catch (\Exception $e) {
            return redirect()->route('usuario')->with('error', 'Ocurrió un error al actualizar los datos de usuario: ' . $e->getMessage()); // Manejo de errores
        }
    }

    // Elimina la cuenta del usuario
    public function eliminarCuenta(Request $request)
    {
        $user = Auth::user(); // Obtiene el usuario autenticado

        if (!$user) {
            return redirect()->route('login')->with('error', 'Usuario no autenticado.'); // Redirige si el usuario no está autenticado
        }

        try {
             /** @var \App\Models\User $user */
            $user->delete(); // Elimina la cuenta del usuario
            Auth::logout(); // Cierra la sesión del usuario

            return redirect('/launchix')->with('success', 'Tu cuenta ha sido eliminada correctamente.'); // Redirige con mensaje de éxito
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Ocurrió un error al eliminar la cuenta: ' . $e->getMessage()); // Manejo de errores
        }
    }

    // Cambia la contraseña del usuario
    public function changePassword(Request $request)
    {
        $user = Auth::user(); // Obtiene el usuario autenticado

        // Valida los datos de entrada para el cambio de contraseña
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        try {
            // Verifica la contraseña actual
            if (!Hash::check($validatedData['current_password'], $user->password)) {
                return redirect()->route('launchix')->with('error', 'La contraseña actual es incorrecta.'); // Error si la contraseña es incorrecta
            }

            // Actualiza la contraseña del usuario
            $user->password = Hash::make($validatedData['new_password']); // Encripta la nueva contraseña
             /** @var \App\Models\User $user */
            $user->save(); // Guarda los cambios en la base de datos

            return redirect()->route('launchix')->with('success', 'Contraseña cambiada exitosamente.'); // Redirige con mensaje de éxito
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Ocurrió un error al cambiar la contraseña: ' . $e->getMessage()); // Manejo de errores
        }
    }

    // UserController.php

public function updateProfilePicture(Request $request)
{
    $user = Auth::user();

    if ($request->hasFile('profilePic')) {
        $profilePic = $request->file('profilePic');
        $path = $profilePic->store('profile_pics', 'public'); // Guarda la imagen en storage/app/public/profile_pics
        $user->profile_picture = $path;
    }

    if ($request->hasFile('coverPic')) {
        $coverPic = $request->file('coverPic');
        $path = $coverPic->store('cover_pics', 'public'); // Guarda la imagen en storage/app/public/cover_pics
        $user->cover_picture = $path;
    }
     /** @var \App\Models\User $user */
    $user->save();

    return redirect()->route('usuario')->with('success', 'Fotos actualizadas exitosamente.');
}

}