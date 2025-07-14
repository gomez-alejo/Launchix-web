<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Esta migración agrega los campos para la foto de perfil y la foto de portada a la tabla users
return new class extends Migration
{
    /**
     * Ejecuta la migración: agrega los campos profile_picture y cover_picture a la tabla users
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Campo para la foto de perfil (puede ser null)
            $table->string('profile_picture')->nullable()->after('description');
            // Campo para la foto de portada (puede ser null)
            $table->string('cover_picture')->nullable()->after('profile_picture');
        });
    }

    /**
     * Revierte la migración: elimina los campos profile_picture y cover_picture
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['profile_picture', 'cover_picture']);
        });
    }
};
