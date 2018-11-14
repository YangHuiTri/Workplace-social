<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入模型
use App\Admin\Member;
use Input;
use DB;

class MemberController extends Controller
{
    //会员列表
    public function index(){
    	//查询数据
    	$data = Member::get();
    	//查询数据总数
    	$count = DB::table('member')->count();
    	//展示视图
    	return view('admin.member.index', compact('data','count'));
    }

    //添加会员
    public function add(){
    	//判断请求类型
    	if(Input::method() == 'POST'){
    		//实现数据的保存
    		//自动验证
    		$result = Member::insert([
    				'username'		=>		Input::get('username'),
    				'password'		=>		bcrypt('123456'),
    				'gender'		=>		Input::get('gender'),
    				'mobile'		=>		Input::get('mobile'),
    				'email'			=>		Input::get('email'),
    				'avatar'		=>		Input::get('avatar'),
    				'country_id'	=>		Input::get('country_id'),
    				'province_id'	=>		Input::get('province_id'),
    				'city_id'		=>		Input::get('city_id'),
    				'county_id'		=>		Input::get('county_id'),
    				'status'		=>		Input::get('status'),
    				'created_at'	=>		date('Y-m-d H:i:s')
    		]);
    		//返回输出
    		return $result ? '1' : '0';

    	}else{
    		//查询数据（国家的数据）
    		$country = DB::table('area')->where('pid','0')->get();
    		//展示视图
    		return view('admin.member.add',compact('country'));
    	} 	
    }

    //ajax四级联动获取下属地区
    public function getAreaById(){
    	//接收id
    	$id = Input::get('id');
    	//根据id去查询下属地区
    	$data = DB::table('area')->where('pid',$id)->get();
    	//返回json数据
    	return response()->json($data);
    }    




}
