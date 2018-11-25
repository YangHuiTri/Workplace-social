<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //定义当前模型需要关联的数据表
    protected $table = 'article';
    //允许插入的字段
    // protected $fillable = ['content','img','author_id','author_name','author_avatar'];
}
