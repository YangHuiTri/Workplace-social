<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Member extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    //定义当前模型需要关联的数据表
    protected $table = 'member';
    //允许插入的字段
    protected $fillable = ['username','age','password','gender','mobile','email','avatar','country_id','province_id','city_id','county_id','status'];

    use Authenticatable;

    //关联模型，关联company表获取学校名，一对一
    public function company(){
    	return $this->hasOne('App\Admin\Company','id','school_id');
    }

}
