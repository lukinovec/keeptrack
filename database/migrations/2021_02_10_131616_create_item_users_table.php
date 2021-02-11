<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('item_id');
            $table->string('type');
            $table->string('searchtype');
            $table->text('status');
            $table->text('note')->nullable();
            $table->integer('rating')->nullable();
            $table->boolean('is_favorite')->default(false);
            $table->json('user_progress')->default('{}');
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
        Schema::dropIfExists('item_users');
    }
}
