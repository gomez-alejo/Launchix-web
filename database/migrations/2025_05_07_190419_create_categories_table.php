<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Insertar categorías predefinidas
        DB::table('categories')->insert([
            ['name' => 'Experiencia'],
            ['name' => 'Historia'],
            ['name' => 'Tecnología'],
            ['name' => 'Viajes'],
            ['name' => 'Cultura'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
