<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建表
        Schema::create('company',function(Blueprint $table){
            $table -> increments('id'); //公司id
            $table -> string('com_name')->notNull();//公司名
            $table -> string('password') -> notNull();//密码
            $table -> string('mobile',11)->notNull();//公司电话
            $table -> string('email',40)->notNull();//公司邮箱
            $table -> integer('emp_count');//员工数
            $table -> text('introduction');//公司简介
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
        Schema::dropIfExists('company');
    }
}
