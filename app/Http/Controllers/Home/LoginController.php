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

        //设置该账号已登录信息，准备放入数据库
        // Session::put('loginEmail',$email);

    	//如果为企业登录
    	if($loginType == 'company'){
    		Session::put('loginType','company');
    		//查询该用户是否存在
    		$count = DB::table('company')->where('email',$email)->count();
    		if($count > 0){
                //判断该用户是否已经在别的地方登陆
                // $is_login = DB::table('company')->where('email', $email)->value('is_login');
                // if(!empty($is_login)){
                //     return redirect('/home/login/index')->withErrors([
                //             'loginError'    =>      '该账号已在其他地方登陆...'
                //         ]);
                // }
                //更新数据库，将session信息放入数据库中
                // $res = DB::table('company')->where('email', $email)->update(['is_login' => Session::get('loginEmail')]);

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
                //判断该用户是否已经在别的地方登陆
                // $is_login = DB::table('member')->where('email', $email)->value('is_login');
                // if(!empty($is_login)){
                //     return redirect('/home/login/index')->withErrors([
                //             'loginError'    =>      '该账号已在其他地方登陆...'
                //         ]);
                // }
                //更新数据库，将session信息放入数据库中
                // $res = DB::table('member')->where('email', $email)->update(['is_login' => Session::get('loginEmail')]);

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
            //先清空数据库中已登录信息
            // DB::table('company')->where('email', Session::get('loginEmail'))->update(['is_login' => '']);
    		//退出登录
    		Auth::guard('company')->logout();
    		//清除session
    		Session::flush();
    		//跳转回首页
    		return redirect('/home/login/index');
    	}elseif (Session::get('loginType') == 'member') {
            //先清空数据库中已登录信息
            // DB::table('member')->where('email', Session::get('loginEmail'))->update(['is_login' => '']);
            //退出登录
    		Auth::guard('member')->logout();
    		Session::flush();
    		return redirect('/home/login/index');
    	}
    }

}
