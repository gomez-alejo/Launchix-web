<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Muestra una lista de todos los blogs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtiene todos los blogs desde la base de datos, cargando los comentarios asociad

        // Iniciar una consulta base para el modelo Area
        // $blogs = Blog::included()->get();
        // return response()->json($blogs);
        
        $blogs = Blog::included()->filter()->get();
        return response()->json($blogs);
        
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

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Request $request, $id)
    {
        // Iniciar una consulta base para el modelo Apprentice
         $blogs = Blog::included()->findOrFail($id);
        return response()->json($blogs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
}
