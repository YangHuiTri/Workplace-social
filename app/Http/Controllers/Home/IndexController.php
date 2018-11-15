<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class IndexController extends Controller
{
    //首页
    public function index(){
    	//展示首页视图
    	return view('home.index.index');
    }

    //登录页面
    public function login(){
    	//展示视图
    	return view('home.index.login');
    }

    //登录处理
    public function check(Request $request){
    	//开始自动验证
    	$this->validate($request,[
    		'email'	=>	'email',	//邮箱
    		'password'	=>	'required|min:6',	//密码，必填，长度至少为6
    	]);
		//接收数据
    	$loginType = $request ->get('loginType');
    	$data = $request -> only(['email','password']);

    	//如果为企业登录
    	if($loginType == 'company'){
    		$result = Auth::guard('company')->attempt($data);
    		if($result){
    			//登录成功，跳转回首页
    			return redirect('/');
    		}else{
    			//登录失败，跳转回登录页面
    			return redirect('/home/index/login')->withErrors([
    				'loginError'	=>		'邮箱或密码错误'
    			]);
    		}
    	}else{
    		//用户登录
    		$result = Auth::guard('member')->attempt($data);
    		if($result){
    			//登录成功，跳转回首页
    			return redirect('/');
    		}else{
    			//登录失败，跳转回登录页面
    			return redirect('/home/index/login')->withErrors([
    				'loginError'	=>		'邮箱或密码错误'
    			]);
    		}
    	}



    }

    //注册页面
    public function register(){
    	//展示视图
    	return view('home.index.register');
    }
}
