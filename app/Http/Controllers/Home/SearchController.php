<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SearchController extends Controller
{
    //个人主页搜索
    public function index(Request $request){
    	//接收数据
    	//搜索的关键字
    	$search_text = $request->search_text;
    	//用户类型
    	$user_type = $request->user_type;
    	//用户id
    	$user_id = $request->user_id;
    	//查询数据
    	$data = DB::table('article')->where('author_type','=',$user_type)->where('author_id','=',$user_id)->where('content','like','%'.$search_text.'%')->where('article_type','=','article')->orderBy('created_at','desc')->get();
    	$data2 = DB::table('article')->where('author_type','=',$user_type)->where('author_id','=',$user_id)->where('recruit_title','like','%'.$search_text.'%')->where('article_type','=','recruit')->orderBy('created_at','desc')->get();
    	$tot = count($data) + count($data2);
    	// dd($data,$data2);


    	//展示视图
    	return view('home.search.index', compact('data','data2','search_text','tot','user_type','user_id'));
    }
}
