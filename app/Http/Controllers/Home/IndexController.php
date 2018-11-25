<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;
use Session;
use Auth;
//引入模型
use App\Home\Article;

class IndexController extends Controller
{
    //首页
    public function index(){
    	//查询当前登录用户共有多少条动态
    	if(Session::get('loginType') == 'company'){
    		$author_id = Auth::guard('company')->user()->id;
            $zan_people = 'company'.'@'.$author_id;
    	}elseif(Session::get('loginType') == 'member'){
    		$author_id = Auth::guard('member')->user()->id;
            $zan_people = 'member'.'@'.$author_id;
    	}
    	$tot = DB::table('article')->where('author_id','=',$author_id)->count();
    	//查询数据
    	// $data = DB::table('article')->get();
    	$data = DB::table('article')->orderBy('created_at','desc')->take(10)->get();
    	//展示首页视图
    	return view('home.index.index', compact('data','tot','zan_people'));
    }

}
