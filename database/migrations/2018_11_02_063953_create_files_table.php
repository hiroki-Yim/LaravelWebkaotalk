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
            $table->unsignedInteger('postid')->nullable()->index()->comment('업로드된 게시글 번호');
            $table->foreign('postid')->references('postid')->on('boards')->onDelete('cascade');
            $table->string('filename')->comment('파일 고유 이름');
            $table->string('filetype')->comment('파일 타입');
            $table->unsignedInteger('filesize')->nullable()->comment('파일 크기');
            
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
