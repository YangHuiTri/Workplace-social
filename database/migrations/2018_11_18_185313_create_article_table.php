<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建表
        Schema::create('article',function(Blueprint $table){
            $table -> increments('id');//id
            $table -> text('content') -> notNull();//动态-内容
            $table -> string('img');//动态-图片
            $table -> tinyInteger('author_id');//作者
            $table -> enum('author_type',[1,2]);//1公司2学校
            $table -> timestamps();
            $table -> rememberToken();
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
        Schema::dropIfExists('article');
    }
}
