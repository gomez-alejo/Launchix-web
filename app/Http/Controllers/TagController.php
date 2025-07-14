<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function index(Request $request)
    {
        // Iniciar una consulta base para el modelo Area
        // $tags = Tag::included()->get();
        $tags=Tag::included()->filter()->get(); 
        return response()->json($tags);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $tag = Tag::create($request->all());
        return response()->json($tag);
    }


    public function show(Request $request, $id)
    {
        // Iniciar una consulta base para el modelo Area
         $tag = Tag::included()->findOrFail($id);
        return response()->json($tag);
    }


    public function edit(Tag $tag)
    {
        //
    }


    public function update(Request $request, Tag $tag)
    {
        //
    }


    public function destroy(Tag $tag)
    {
        //
    }
}
