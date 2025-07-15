<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(Request $request)
    {
        // Iniciar una consulta base para el modelo Area
        // $categories = Category::included()->get();
        $categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($categories);
    }


    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $category = Category::create($request->all());
        return response()->json($category);
    }

    public function show(Request $request, $id)
    {
        // Iniciar una consulta base para el modelo Area
         $category = Category::included()->findOrFail($id);
        return response()->json($category);
    }
}
