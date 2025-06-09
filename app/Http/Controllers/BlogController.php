<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Muestra una lista de todos los blogs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todos los blogs desde la base de datos, cargando los comentarios asociados
        $blogs = Blog::with('comments')->get();

        // Obtiene todas las categorías desde la base de datos
        $categories = Category::all();

        // Retorna la vista de blogs con los datos de los blogs y las categorías
        return view('blogs', compact('blogs', 'categories'));
    }

    /**
     * Almacena un nuevo blog en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valida los datos de entrada del blog
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Si se ha subido una imagen, procesarla y guardar la ruta
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $data['image_path'] = 'images/'.$imageName;
        }

        // Crea un nuevo blog con los datos procesados
        Blog::create($data);

        // Redirige a la lista de blogs con un mensaje de éxito
        return redirect()->route('blogs.index')->with('success', 'Blog publicado con éxito');
    }

    /**
     * Actualiza un blog específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Blog $blog)
    {
        // Verifica si el usuario autenticado es el propietario del blog
        if (Auth::id() != $blog->user_id) {
            return redirect()->route('blogs.index')->with('error', 'No tienes permiso para editar este blog.');
        }

        // Valida los datos de entrada del blog
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Si se ha subido una imagen, procesarla y guardar la ruta
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $data['image_path'] = 'images/'.$imageName;
        }

        // Actualiza el blog con los datos procesados
        $blog->update($data);

        // Redirige a la lista de blogs con un mensaje de éxito
        return redirect()->route('blogs.index')->with('success', 'Blog actualizado con éxito');
    }

    /**
     * Elimina un blog específico de la base de datos.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Blog $blog)
    {
        // Verifica si el usuario autenticado es el propietario del blog
        if (Auth::id() != $blog->user_id) {
            return redirect()->route('blogs.index')->with('error', 'No tienes permiso para eliminar este blog.');
        }

        // Elimina el blog
        $blog->delete();

        // Redirige a la lista de blogs con un mensaje de éxito
        return redirect()->route('blogs.index')->with('success', 'Blog eliminado con éxito');

    }
}
