<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $data = $request->all();
    
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'), $imageName);
            $data['image_path'] = 'images/'.$imageName;
        }
    
        Blog::create($data);
    
        return redirect()->route('blogs.index')->with('success', 'Blog publicado con éxito');
    }
    
}