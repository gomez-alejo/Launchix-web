<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;

class UserController extends Controller
{

    public function index(Request $request)
    {
        // Iniciar una consulta base para el modelo Area
        // $users = User::included()->get();
        $users=User::included()->filter()->sort()->getOrPaginate();;
        return response()->json($users);
    }

    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'firstName' => 'required|max:255',
            'lastName'=> 'required|max:255',
            'username'=> 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $user = User::create($request->all());
        return response()->json($user);
    }

    public function show(Request $request, $id)
    {
        // Iniciar una consulta base para el modelo Area
         $user = User::included()->findOrFail($id);
        return response()->json($user);
    }
    
    // Muestra el perfil del usuario autenticado
    public function showProfile()
    {
        $user = Auth::user(); // Obtiene el usuario autenticado
        $blogs = Blog::where('user_id', $user->id)->with('comments')->get(); // Obtiene los blogs del usuario con sus comentarios
        $categories = Category::all(); // Obtiene todas las categorías

        return view('usuario', compact('user', 'blogs', 'categories')); // Retorna la vista 'usuario' con los datos del usuario, blogs y categorías
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
    $user = Auth::user();

    // Verificar que $user es una instancia del modelo User
    if (!$user instanceof \App\Models\User) {
        throw new \Exception('El usuario no es una instancia válida del modelo User.');
    }

    if (!$user) {
        return redirect()->route('login')->with('error', 'Usuario no autenticado.');
    }

    try {
        // Elimina todos los comentarios asociados a los blogs del usuario
        $blogs = $user->blogs;
        foreach ($blogs as $blog) {
            $blog->comments()->delete();
            $blog->delete();
        }

        // Elimina la cuenta del usuario
        $user->delete();

        Auth::logout();
        return redirect('/launchix')->with('success', 'Tu cuenta y todos tus blogs han sido eliminados correctamente.');
    } catch (\Exception $e) {
        return redirect()->route('home')->with('error', 'Ocurrió un error al eliminar la cuenta: ' . $e->getMessage());
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

    // Actualiza la foto de perfil y la foto de portada del usuario
    public function updateProfilePicture(Request $request)
    {
        $user = Auth::user(); // Obtiene el usuario autenticado

        // Si se subió una nueva foto de perfil
        if ($request->hasFile('profilePic')) {
            $profilePic = $request->file('profilePic');
            // Guarda la imagen en storage/app/public/profile_pics y almacena la ruta
            $path = $profilePic->store('profile_pics', 'public');
            $user->profile_picture = $path;
        }

        // Si se subió una nueva foto de portada
        if ($request->hasFile('coverPic')) {
            $coverPic = $request->file('coverPic');
            // Guarda la imagen en storage/app/public/cover_pics y almacena la ruta
            $path = $coverPic->store('cover_pics', 'public');
            $user->cover_picture = $path;
        }
        /** @var \App\Models\User $user */
        $user->save(); // Guarda los cambios en la base de datos

        // Redirige al perfil con mensaje de éxito
        return redirect()->route('usuario')->with('success', 'Fotos actualizadas exitosamente.');
    }

    // En tu controlador
    public function showUsuarioView()
    {
        $user = Auth::user(); // Obtener el usuario autenticado
        $categories = Category::all(); // Obtener todas las categorías
        $blogs = $user->blogs; // Obtener todos los blogs del usuario

        return view('usuario', compact('user', 'categories', 'blogs'));
    }

    public function getUserBlogs($userId)
    {
        $blogs = Blog::where('user_id', $userId)->with('category')->get();
        return view('partials.blogs', compact('blogs'));
    }
}
