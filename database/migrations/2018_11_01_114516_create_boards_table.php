<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {           

        Schema::create('boards', function (Blueprint $table) {  //migrate
            $table->increments('postid')->comment('게시글 번호');
            $table->string('author')->comment('게시글 작성자');
            $table->string('title')->comment('게시글 제목');
            $table->text('content')->comment('게시글 내용');
            $table->integer('groupord')->nullable()->comment('부모 소속 게시글 순서');
            $table->integer('depth')->nullable()->comment('게시판 답글 순서');
            $table->integer('viewCount')->unsigned()->default(0)->comment('게시글 조회수');
                                        //unsigned 같은 경우에는 음수를 사용하지 않으니 사용하지 않는 음수만큼 양수로 옮김 -(sign값)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()  //rollback
    {
        Schema::dropIfExists('boards');
    }
}
