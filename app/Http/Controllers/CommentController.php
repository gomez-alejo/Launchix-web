<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|exists:blogs,id',
            'content' => 'required|string',
        ]);

        $comment = Comment::create([
            'blog_id' => $request->blog_id,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Comentario agregado correctamente', 'comment' => $comment]);
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
