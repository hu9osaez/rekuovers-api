<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('username', 32)->unique();
            $table->string('email')->unique();
            $table->string('password', 60)->nullable();
            $table->boolean('confirmed')->default(false);
            $table->string('confirmation_code')->nullable();
            $table->string('facebook_id')->nullable();
            $table->timestamp('last_signin')->nullable();
            $table->ipAddress('last_signin_ip')->nullable();
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
        Schema::drop('users');
    }
}
