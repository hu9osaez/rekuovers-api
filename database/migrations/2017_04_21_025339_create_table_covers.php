<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCovers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('song_id')->unsigned();
            $table->integer('publisher_id')->unsigned()->default(1);
            $table->string('type', 5);
            $table->string('youtube_id');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('song_id')->references('id')->on('songs');
            $table->foreign('publisher_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('covers');
    }
}
