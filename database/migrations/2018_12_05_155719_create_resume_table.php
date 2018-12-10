<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建表
        Schema::create('resume',function(Blueprint $table){
            $table -> increments('id');//id
            $table -> string('start_time');//开始时间
            $table -> string('end_time');//结束时间
            $table -> string('name');//名称
            $table -> string('duty');//职责
            $table -> string('content');//描述
            $table -> string('type');//种类
            $table -> integer('user_id');//所属用户
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
        Schema::dropIfExists('resume');
    }
}
