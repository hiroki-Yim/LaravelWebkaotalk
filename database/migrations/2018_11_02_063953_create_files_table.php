<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->increments('id')->comment('파일 고유 번호');
            $table->integer('postnum')->unsigned()->comment('게시글 번호');
            $table->foreign('postnum')->references('postid')->on('boards')->onDelete('cascade');
            $table->string('filename')->comment('파일 고유 이름');
            $table->string('filesavename')->comment('파일 해시 이름');
            $table->string('fileurl')->comment('저장된 위치');
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
        Schema::dropIfExists('files');
    }
}
