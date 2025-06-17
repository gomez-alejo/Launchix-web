<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraph,
            'blog_id' => Blog::factory(), // Esto creará un blog automáticamente
            'user_id' => User::factory(), // Esto creará un usuario automáticamente
            
        ];
    }
}