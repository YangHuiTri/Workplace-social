<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建表
        Schema::create('comment', function(Blueprint $table){
            $table -> increments('id');//id
            $table -> text('content');//评论-内容
            $table -> string('article_id');//文章id
            $table -> integer('author_id');//评论者id
            $table -> string('author_name');//评论者名称
            $table -> string('author_avatar');//评论者头像
            $table -> timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除表
        Schema::dropIfExists('comment');
    }
}
