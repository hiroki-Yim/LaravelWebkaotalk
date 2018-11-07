<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()    //migration시 실행
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id')->comment('댓글 고유 번호');//auto_increment, PK
            $table->integer('postnum')->unsigned()->comment('게시글 번호');
            $table->foreign('postnum')->references('postid')->on('boards')->onDelete('cascade');
            $table->string('writer')->comment('댓글 작성자');
            $table->string('content')->comment('댓글 내용');
            $table->string('mnum')->nullable()->comment('부모 댓글 번호');
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
