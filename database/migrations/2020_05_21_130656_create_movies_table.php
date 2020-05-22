<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->text('image', 200);
            $table->text('name', 100);
            $table->text('director', 100);
            $table->text('czech_name', 100);
            $table->text('description', 200);
            $table->year('year');
            $table->integer('rating');
            $table->integer('progress_seasons');
            $table->integer('progress_episodes');
            $table->timestamp('completed')->nullable();
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
        Schema::dropIfExists('movies');
    }
}
