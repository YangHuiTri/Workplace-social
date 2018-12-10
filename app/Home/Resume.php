<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    //定义当前模型需要关联的数据表
    protected $table = 'resume';
    //允许插入的字段
    protected $fillable = ['start_time','end_time','title','duty','type','content','user_id'];
}
