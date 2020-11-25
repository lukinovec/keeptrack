<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('movie_id');
            $table->text('status');
            $table->text('note')->nullable();
            $table->integer('rating')->nullable();
            $table->boolean('is_favorite');
            $table->integer('season')->nullable();
            $table->integer('episode')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_user');
    }
}
