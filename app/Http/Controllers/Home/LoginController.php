<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;

class LoginController extends Controller
{
    //登录页面
    public function index(){
    	//展示视图
    	return view('home.login.index');
    }


    //登录处理
    public function loginCheck(Request $request){
    	//开始自动验证
    	$this->validate($request,[
    		'email'	=>	'email',	//邮箱
    		'password'	=>	'required|min:6',	//密码，必填，长度至少为6
    	]);
		//接收数据
		$email = $request->email;
    	$loginType = $request ->get('loginType');
    	$data = $request -> only(['email','password']);
        $data['status'] = '2';  //要求状态为启用的用户

    	//如果为企业登录
    	if($loginType == 'company'){
    		Session::put('loginType','company');
    		//查询该用户是否存在
    		$count = DB::table('company')->where('email',$email)->count();
    		if($count > 0){
    			$result = Auth::guard('company')->attempt($data);
	    		if($result){
	    			//登录成功，跳转回首页
	    			return redirect('/');
	    		}else{
	    			//登录失败，跳转回登录页面
	    			return redirect('/home/login/index')->withErrors([
	    				'loginError'	=>		'邮箱或密码错误或账号状态有误'
	    			]);
	    		}
    		}else{
    			return redirect('home/login/index')->withErrors([
    				'emailError'	=>		'该账户还未注册为企业账号'
    			]);
    		}
    		
    	}else{
    		//用户登录
    		//查询该用户是否存在
    		Session::put('loginType','member');
    		$count = DB::table('member')->where('email',$email)->count();
    		if($count > 0){
    			$result = Auth::guard('member')->attempt($data);
	    		if($result){
	    			//登录成功，跳转回首页
	    			return redirect('/');
	    		}else{
	    			//登录失败，跳转回登录页面
	    			return redirect('/home/login/index')->withErrors([
	    				'loginError'	=>		'邮箱或密码错误'
	    			]);
	    		}
    		}else{
    			return redirect('home/login/index')->withErrors([
    				'emailError'	=>		'该用户尚未注册'
    			]);
    		}
    		
    	}

    }





    //退出登录
    public function logout(){
    	if(Session::get('loginType') == 'company'){
    		//退出登录
    		Auth::guard('company')->logout();
    		//清除session
    		Session::flush();
    		//跳转回首页
    		return redirect('/home/login/index');
    	}elseif (Session::get('loginType') == 'member') {
    		Auth::guard('member')->logout();
    		Session::flush();
    		return redirect('/home/login/index');
    	}
    }

}
