<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->text('goodreadsID');
            $table->text('image', 200);
            $table->text('name', 100);
            $table->text('author', 100);
            $table->text('czech_name', 100);
            $table->text('description', 200);
            $table->year('year');
            $table->integer('rating');
            $table->integer('progress_chapters');
            $table->integer('progress_pages');
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
        Schema::dropIfExists('books');
    }
}
