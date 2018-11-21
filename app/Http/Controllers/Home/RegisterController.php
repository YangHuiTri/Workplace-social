<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入模型
use App\Admin\Company;
use App\Admin\Member;
use DB;
use Auth;
use Session;

class RegisterController extends Controller
{
    //注册页面
    public function index(){
    	//展示视图
    	return view('home.register.index');
    }


    //注册处理
    public function regCheck(Request $request){
        //接收注册类型（企业或者用户）
        $regType = $request->get('regType');
        if($regType == 'company'){
            //注册企业
            //自动验证数据各字段
            $this->validate($request,[
                'email'     =>      'email|unique:company,email',
                'password'  =>      'required|min:6|max:20|confirmed',
                'captcha'   =>      'captcha',
                'mobile'    =>      'regex:/^1[34578][0-9]{9}$/',
            ]);
            //接收表单传过来的数据
            $email = request('email');
            $password = bcrypt(request('password'));
            $mobile = request('mobile');
            //将数据存入$data数组中
            $data = [
                'email' =>  $email,
                'password'  =>  $password,
                'mobile'    =>  $mobile,
                'avatar'    =>  '/statics/avatar.jpg'
            ];
            //数据入库
            $result = Company::create($data);
            if($result){
                //注册成功，跳转到登录页面
                return redirect('/home/login/index')->with([
                    'msg'  =>  '欧耶~~~企业账户注册成功，请登录！'
                ]);
            }else{
                //注册失败,回到注册页面
                return redirect('/home/register/index')->withErrors([
                    'regError' => '注册失败，请重新尝试！'
                ]);

            }  
        }elseif($regType == 'member'){
            //注册用户
            //自动验证数据各字段
            $this->validate($request,[
                'email'     =>      'email|unique:member,email',
                'password'  =>      'required|min:6|max:20|confirmed',
                'captcha'   =>      'captcha',
                'mobile'    =>      'regex:/^1[34578][0-9]{9}$/',
            ]); 
            //接收表单传过来的数据
            $email = request('email');
            $password = bcrypt(request('password'));
            $mobile = request('mobile');
            //将数据存入$data数组中
            $data = [
                'email' =>  $email,
                'password'  =>  $password,
                'mobile'    =>  $mobile,
                'avatar'    =>  '/statics/avatar.jpg'
            ];
            //数据入库
            $result = Member::create($data);
            if($result){
                //注册成功，跳转到登录页面
                return redirect('/home/login/index')->with([
                    'msg'  =>  '欧耶~~~普通用户注册成功，请登录！'
                ]);
            }else{
                //注册失败,回到注册页面
                return redirect('/home/register/index')->withErrors([
                    'regError' => '注册失败，请重新尝试！'
                ]);

            } 

        }
    }
}
