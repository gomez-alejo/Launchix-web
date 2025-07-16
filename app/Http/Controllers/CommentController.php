<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        Comment::create([
            'blog_id' => $request->blog_id,
            'user_id' => Auth::id(), // Asegúrate de incluir el user_id
            'content' => $request->content,
        ]);

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
}
