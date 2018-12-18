<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建表
        Schema::create('manager',function(Blueprint $table){
            //设计字段
            $table -> increments('id');//主键
            $table -> string('username',20) -> notNull();//用户名，长度20，不能为空
            $table -> string('password') -> notNull();//密码，varchar(255)
            $table -> enum('gender',[1,2,3]) -> notNull() -> default('1');//性别，1=男，2=女，3=保密
            $table -> string('mobile',11);//手机号，varchar(11)
            $table -> string('email',50);//邮箱
            $table -> timestamps();
            $table -> rememberToken();
            $table -> enum('status',[1,2]) -> notNull() -> default('2');//状态，1=禁用，2=正常
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
        Schema::dropIfExists('manager');
    }
}
