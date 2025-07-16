<?php

namespace App\Http\Controllers;

use App\Models\Like;
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

        $like = Like::create($request->all());
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

    
    public function destroy(Like $like)
    {
        //
    }
}
