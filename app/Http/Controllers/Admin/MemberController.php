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
    	$data = Member::where('status','<','3')->get();
    	//查询数据总数
    	$count = count($data);
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
                    'age'           =>      Input::get('age'),
    				'gender'		=>		Input::get('gender'),
    				'mobile'		=>		Input::get('mobile'),
    				'email'			=>		Input::get('email'),
    				'avatar'		=>		Input::get('avatar') ? Input::get('avatar') : '/statics/avatar.jpg',
    				'country_id'	=>		Input::get('country_id'),
    				'province_id'	=>		Input::get('province_id'),
    				'city_id'		=>		Input::get('city_id'),
    				'county_id'		=>		Input::get('county_id'),
    				'status'		=>		Input::get('status'),
                    'is_recommend'  =>      '2',
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

    //停用会员
    public function stop(Request $request){
        //接收要禁用的用户id
        $id = $request->id;
        //从数据库禁用该用户
        $result = DB::table('member')->where('id','=',$id)->update(['status'=>'1']);
        //返回输出
        return $result ? '1' : '0';
    }

    //启用会员
    public function start(Request $request){
        //接收用户id
        $id = $request->id;
        //从数据库启用该用户
        $result = DB::table('member')->where('id','=',$id)->update(['status'=>'2']);
        //返回输出
        return $result ? '1' : '0';
    }

    //删除用户
    public function del(Request $request){
        //接收用户id
        $id = $request->id;
        //从数据库中删除该用户
        $result = DB::table('member')->where('id','=',$id)->update(['status'=>'3']);
        //返回输出
        return $result ? '1' : '0';
    }

    //已删除的会员
    public function deleted(){
        //查询数据
        $data = Member::where('status','=','3')->get();
        //查询数据总数
        $count = count($data);
        //展示视图
        return view('admin.member.deleted', compact('data','count'));
    }

    //撤销删除
    public function revoke(Request $request){
        //用户id
        $id = $request->id;
        //更新数据库
        $result = Member::where('id','=',$id)->update(['status'=>'2']);
        //返回输出
        return $result ? '1' : '0';
    }

    //彻底删除用户
    public function removed(Request $request){
        //用户id
        $id = $request->id;
        //从数据库中删除该用户
        $result = Member::where('id','=',$id)->delete();
        //返回输出
        return $result ? '1' : '0';
    }





}
