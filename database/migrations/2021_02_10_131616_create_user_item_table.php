<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_item', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('item_id');
            $table->foreign('item_id')->references('apiID')->on('items');
            $table->string('searchtype');
            $table->foreign('searchtype')->references('type')->on('statuses');
            $table->text('status');
            $table->text('note')->nullable();
            $table->integer('rating')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->json('user_progress');
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
        Schema::dropIfExists('user_item');
    }
}
