<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Introducción a la Ciencia',
                'content' => 'Este es un blog sobre la introducción a la ciencia y sus maravillas.',
                'category_id' => 1,
                'user_id' => 1, // Asegúrate de que este user_id exista en la tabla users
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Técnicas Avanzadas de Deportes',
                'content' => 'Aquí encontrarás técnicas avanzadas para mejorar en varios deportes.',
                'category_id' => 2,
                'user_id' => 2, // Asegúrate de que este user_id exista en la tabla users
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'La Historia del Arte',
                'content' => 'Un recorrido por la historia del arte y sus movimientos más influyentes.',
                'category_id' => 3,
                'user_id' => 3, // Asegúrate de que este user_id exista en la tabla users
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Recetas de Gastronomía Internacional',
                'content' => 'Descubre recetas de gastronomía de diferentes partes del mundo.',
                'category_id' => 4,
                'user_id' => 4, // Asegúrate de que este user_id exista en la tabla users
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Consejos para una Vida Saludable',
                'content' => 'Consejos y trucos para llevar una vida más saludable y equilibrada.',
                'category_id' => 5,
                'user_id' => 5, // Asegúrate de que este user_id exista en la tabla users
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
