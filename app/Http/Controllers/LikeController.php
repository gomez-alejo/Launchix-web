<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Blog;
use App\Models\User;
use App\Notifications\BlogInteractionNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    public function index(Request $request)
    {
        // Iniciar una consulta base para el modelo Area
        // $likes = Like::included()->get();
        $likes = Like::included()->filter()->sort()->getOrPaginate();;
        return response()->json($likes);
    }

  
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Buscar si ya existe un like para este usuario y blog
        $existingLike = Like::where('user_id', $request->user_id)
                            ->where('blog_id', $request->blog_id)
                            ->first();

        if ($existingLike) {
            // Si ya existe, no se permite otro like
            // Comentario: Se evita que el usuario pueda dar más de un like al mismo blog
            return response()->json([
                'message' => 'Ya diste like a este blog'
            ], 409); // 409 = conflicto
        }

        // Si no existe, se crea el like
        $like = Like::create($request->all());

        // Obtener el blog y su dueño
        $blog = Blog::find($request->blog_id);
        $blogOwner = $blog->user;
        $actor = User::find($request->user_id); // Usuario que da like

        // Notificar al dueño del blog si el que da like no es el mismo dueño
        if ($blogOwner && $blogOwner->id !== $actor->id) {
            // Se envía la notificación personalizada para like
            $blogOwner->notify(new BlogInteractionNotification(
                'like',
                $blog,
                $actor
            ));
        }

        // Comentario para el equipo: Se agregó el envío de notificación al dueño del blog cuando alguien le da like, usando BlogInteractionNotification.
        // Si el usuario da like en su propio blog, no se notifica a sí mismo.

        return response()->json($like);
    }


    public function show(Request $request, $id)
    {
        // Iniciar una consulta base para el modelo Area
         $like = Like::included()->findOrFail($id);
        return response()->json($like);
    }
    public function edit(Like $like)
    {
        //
    }


    public function update(Request $request, Like $like)
    {
        //
    }

    
    /**
     * Elimina el like de un usuario para un blog específico (unlike).
     * Endpoint: DELETE /api/likes/{blog_id}/user/{user_id}
     * Devuelve JSON con mensaje de éxito o error.
     */
    public function destroyByBlogAndUser($blog_id, $user_id)
    {
        $like = Like::where('blog_id', $blog_id)->where('user_id', $user_id)->first();
        if ($like) {
            $like->delete();
            // Comentario: Se eliminó el like correctamente (unlike)
            return response()->json(['message' => 'Like eliminado correctamente.']);
        } else {
            // Comentario: No se encontró el like para eliminar
            return response()->json(['message' => 'No se encontró el like.'], 404);
        }
    }
}
