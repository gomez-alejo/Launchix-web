<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Ciencia'],
            ['name' => 'Deportes'],
            ['name' => 'Arte'],
            ['name' => 'Gastronomía'],
            ['name' => 'Salud'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
