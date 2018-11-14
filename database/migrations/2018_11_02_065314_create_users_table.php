<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('users PK');
            $table->string('email')->uniuqe()->comment('users account & email');
            $table->string('password')->comment('users password');
            $table->string('nickname')->nullable()->comment('users nickname');
            $table->string('profileImg')->nullable()->comment('users profile');
            $table->string('phone')->nullable()->comment('users phone number');
            // $table->string('addr')->nullable()->comment('users address');
            $table->integer('point')->default(0)->comment('users point');
            $table->boolean('gender')->nullable()->comment('users gender');
            $table->rememberToken();    //세션이 오래 유지됨
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
        Schema::dropIfExists('users');
    }
}
