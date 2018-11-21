<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Company extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //定义当前模型需要关联的数据表
    protected $table = 'company';
    //允许插入的字段
    protected $fillable = ['com_name','password','mobile','email','emp_count','introduction'];

    use Authenticatable;

}
