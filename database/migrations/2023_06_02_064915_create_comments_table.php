<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('berita_id')->constrained('beritas');
            $table->foreignId('user_id')->constrained('users');
            $table->text('comment');
            $table->integer('like', false, true)->default(0);
            $table->integer('dislike', false, true)->default(0);
            $table->tinyInteger('is_main', false, true)->default(1);
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
        Schema::dropIfExists('comments');
    }
}
