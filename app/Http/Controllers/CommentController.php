<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BlogInteractionNotification;

class CommentController extends Controller
{

    public function index(Request $request)
    {
        // Iniciar una consulta base para el modelo Area
        // $comments = Comment::included()->get();
        $comments=Comment::included()->filter()->sort()->getOrPaginate();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        // Crear el comentario y asociar el usuario autenticado
        $comment = Comment::create([
            'blog_id' => $request->blog_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        // Obtener el blog y su dueño
        $blog = Blog::find($request->blog_id);
        $blogOwner = $blog->user;

        // Notificar al dueño del blog si el que comenta no es el mismo dueño
        if ($blogOwner && $blogOwner->id !== Auth::id()) {
            // Se envía la notificación personalizada con el contenido del comentario
            $blogOwner->notify(new BlogInteractionNotification(
                'comment',
                $blog,
                Auth::user(),
                $request->content
            ));
        }

        // Comentario para el equipo: Se agregó el envío de notificación al dueño del blog cuando alguien comenta, usando BlogInteractionNotification.
        // Si el usuario comenta en su propio blog, no se notifica a sí mismo.

        return redirect()->route('blogs.index')->with('success', 'Comentario agregado correctamente');

        $comment = Comment::create($request->all());
        return response()->json($comment);
    }

    public function show(Request $request, $id)
    {
        // Iniciar una consulta base para el modelo Area
         $comment = Comment::included()->findOrFail($id);
        return response()->json($comment);
    }

    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Comentario actualizado correctamente', 'comment' => $comment]);
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(['message' => 'Comentario eliminado correctamente']);
    }

    public function indexApi()
    {
        $comment = Comment::all();
        
        $data = [
            'comments' => $comment,
            'status' => 200 
            ];
        return response()->json($comment,200);
    }
}
