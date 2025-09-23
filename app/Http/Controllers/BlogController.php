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
    // public function index()
    // {
    //     // Obtiene todos los blogs desde la base de datos, cargando los comentarios asociados
    //     $blogs = Blog::with('comments')->get();

    //     // Obtiene todas las categorías desde la base de datos
    //     $categories = Category::all();

    //     // Retorna la vista de blogs con los datos de los blogs y las categorías
    //     return view('blogs', compact('blogs', 'categories'));



    //     // Obtiene todos los blogs desde la base de datos, cargando los comentarios asociad

    //     // Iniciar una consulta base para el modelo Area
    //     $blogs = Blog::included()->get();
    //     // return response()->json($blogs);
        
    //     // $blogs = Blog::included()->filter()->sort()->get();
    //     return response()->json($blogs);
        
    // }

//////////////////////////////

    public function index()
{
    // Obtiene todos los blogs desde la base de datos, aplicando included, filter y sort
    $blogs = Blog::included()->filter()->sort()->getOrPaginate();

    // Obtiene todas las categorías desde la base de datos
    $categories = Category::all();

    // Verifica si la solicitud espera una respuesta JSON

    //para que funcione este en potsman al lado donde dice"params", "Authorization" al lado dice headers se ingresa ahi en la parte de key se pone "Accept" y en value se pone: "application/json"
    if (request()->expectsJson()) {
        // Retorna los blogs en formato JSON
        return response()->json([
            'blogs' => $blogs,
            'categories' => $categories
        ]);
    } else {
        // Retorna la vista de blogs con los datos de los blogs y las categorías
        return view('blogs', compact('blogs', 'categories'));
    }
}





    public function store(Request $request)
    {
        // Valida los datos de entrada del blog
        $request->validate([
            'title' => 'required|string|max:255', // Título es obligatorio, debe ser una cadena y máximo 255 caracteres
            'content' => 'required|string', // Contenido es obligatorio y debe ser una cadena
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Ruta de la imagen es opcional, debe ser una imagen de tipo jpeg, png, jpg, gif y máximo 2048 KB
            'category_id' => 'required|exists:categories,id', // ID de categoría es obligatorio y debe existir en la tabla categories
            'user_id' => 'required|exists:users,id', // ID de categoría es obligatorio y debe existir en la tabla categories
        ]);

        // Obtiene todos los datos del formulario
        $data = $request->all();

        // Si se ha subido una imagen, procesarla y guardar la ruta
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time().'.'.$image->extension(); // Genera un nombre único para la imagen
            $image->move(public_path('images'), $imageName); // Mueve la imagen a la carpeta pública 'images'
            $data['image_path'] = 'images/'.$imageName; // Guarda la ruta de la imagen en los datos
        }

        // Crea un nuevo blog con los datos procesados
        Blog::create($data);

        // Redirige a la lista de blogs con un mensaje de éxito
        return redirect()->route('blogs.index')->with('success', 'Blog publicado con éxito');


        // Validar los datos de entrada
        
        $blogs = Blog::create($request->all());
        return response()->json($blogs);
    }

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



    public function show(Request $request, $id)
    {
        $blog = Blog::with(['user', 'tags', 'comments', 'likes'])->findOrFail($id);
        // Contadores para likes y comentarios
        $blog->likes_count = $blog->likes->count();
        $blog->comments_count = $blog->comments->count();
        return view('blogs_show', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
}
