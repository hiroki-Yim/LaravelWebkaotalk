<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('means', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('word_id')->unsigned();
            $table->foreign('word_id')->references('id')->on('words')->onDelete('cascade');
            $table->string('mean');
            $table->string('class');
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
        Schema::dropIfExists('means');
    }
}
