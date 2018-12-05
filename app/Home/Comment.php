<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //定义当前模型需要关联的数据表
    protected $table = 'comment';
    //允许插入的字段
    protected $fillable = ['content','article_id','author_id','author_name','author_avatar','author_type','pid'];

    // //关联模型，关联文章表，一对一（每条评论对应一篇文章）
    // public function article(){
    // 	return $this->hasOne('App\Home\Article', 'id', 'article_id');
    // }
}
