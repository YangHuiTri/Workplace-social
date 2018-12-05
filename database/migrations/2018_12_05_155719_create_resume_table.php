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
            $table -> string('city');//期望诚实
            $table -> integer('category_id');//职能类别
            $table -> integer('recruit_type');//职能性质，全职/实习/兼职
            $table -> integer('status');//目前状态，1找工作，2准备换工作，3已经找到工作
            $table -> integer('is_recommend')->default(2);//是否被推荐，1否2是
            $table -> integer('user_id');
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
