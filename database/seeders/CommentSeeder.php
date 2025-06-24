<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Asegúrate de que esta línea esté presente

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('comments')->insert([
           ['blog_id' => 1, 'content' => 'Hola, muy buen blog', 'user_id' => 1],  
        ]);
    }
}
