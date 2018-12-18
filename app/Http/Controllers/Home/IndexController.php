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
    	// $data = DB::table('article')->orderBy('created_at','desc')->get();
    	$data = DB::table('article')->orderBy('created_at','desc')->take(10)->get();
        // $data = DB::table('article')->orderBy('created_at','desc')->paginate(10);
    	//展示首页视图
    	return view('home.index.index', compact('data','tot','zan_people'));
    }

    //首页搜索
    public function search(Request $request){
        //接收搜索内容
        $text = $request->search_text;
        //查询数据
        $data = DB::table('article')->where('recruit_title','like','%'.$text.'%')->get();
        //总数据
        $tot = number_format(count($data));
        for($i = 0; $i < $tot; $i++){
            //查询省份
            $province_id = $data[$i]->province_id;
            $province = DB::table('area')->where('id','=',$province_id)->value('area');
            $data[$i]->province = $province;//将省份数据插入data中
            //查询城市
            $city_id = $data[$i]->city_id;
            $city = DB::table('area')->where('id','=',$city_id)->value('area');
            $data[$i]->city = $city;//将城市数据插入到data中
        }
        // dd($data);
        //展示视图
        return view('home.index.search', compact('data','text','tot'));
    }

}
