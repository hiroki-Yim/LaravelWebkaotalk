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
            $table->string('title')->comment('게시글 제목');    //참조하고 있는 놈들 update or delete 부모가 되면 자식도 바뀜
            $table->text('content')->comment('게시글 내용');
            $table->unsignedInteger('groupord')->nullable()->comment('부모 소속 게시글 순서');
            $table->unsignedInteger('depth')->nullable()->comment('게시판 답글 순서');
            // $table->unsignedInteger('viewCount')->default(0)->comment('게시글 조회수');
            //unsigned 같은 경우에는 음수를 사용하지 않으니 사용하지 않는 음수만큼 양수로 옮김 -(sign값)
            $table->timestamps();
        });
        // Schema::table('boards', function (Blueprint $table) {  //migrate
        //     $table->foreign('author')->references('nickname')->on('users')->onDelete('cascade')->onUpdate('cascade'); //게시글 작성자는 유저테이블 nickname임
        // });
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
