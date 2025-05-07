<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id'); // 👈 Campo agregado
            $table->timestamps();
        
            // Claves foráneas
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users'); //
        });
    }

    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
