<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class PublicController extends Controller
{
    //后台登录
    public function login(){
    	//展示视图
    	return view('admin.public.login');
    }

    //验证数据
    public function check(Request $request){
    	//开始自动验证
    	$this->validate($request,[
    		'username'	=>	'required|min:2|max:20',	//用户名，必填，长度介于2-20
    		'password'	=>	'required|min:6',	//密码，必填，长度至少为6
    		'captcha'	=>	'required|size:5|captcha'	//验证码，必填，长度等于5，必须是合法的验证码
    	]);
    	//继续开始进行身份核实
    	$data = $request -> only(['username','password']);
    	$data['status'] = '2';	//要求状态为启用的用户
    	$result = Auth::guard('admin')->attempt($data,$request->get('online'));
    	//判断是否成功
    	if($result){
    		//跳转到后台页面
    		return redirect('/admin/index/index');
    	}else{
    		//跳到登录页
    		return redirect('/admin/public/login')->withErrors([
    			'loginError'	=>	'用户名或密码错误或账号状态非法'
    		]);
    	}
    }

    //退出登录
    public function logout(){
    	Auth::guard('admin')->logout();
    	//跳转回登录页面
    	return redirect('/admin/public/login');

    }
}
