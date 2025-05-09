<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Almacena un nuevo comentario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        $comment = Comment::create([
            'content' => $request->content,
            'blog_id' => $request->blog_id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Comentario publicado con éxito');
    }

    /**
     * Actualiza el comentario especificado en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Comentario actualizado con éxito']);
    }

    /**
     * Elimina el comentario especificado de la base de datos.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json(['message' => 'Comentario eliminado con éxito']);
    }
}
