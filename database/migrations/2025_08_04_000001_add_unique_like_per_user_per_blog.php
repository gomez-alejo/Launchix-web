<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Agrega un índice único para evitar likes duplicados por usuario y blog
        Schema::table('likes', function (Blueprint $table) {
            $table->unique(['user_id', 'blog_id'], 'unique_like_per_user_per_blog');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Elimina el índice único si se revierte la migración
        Schema::table('likes', function (Blueprint $table) {
            $table->dropUnique('unique_like_per_user_per_blog');
        });
    }
};
