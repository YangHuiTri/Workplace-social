<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ArticleController extends Controller
{
    //普通动态列表
    public function index(){
    	//查询数据
    	$data = DB::table('article')->where('article_type','=','article')->get();
    	//动态总数量
    	$tot = count($data);
    	//展示视图
    	return view('admin.article.index', compact('data','tot'));
    }

    //删除普通动态
    public function del_art(Request $request){
    	//文章id
    	$id = $request->id;
    	//从数据库中删除该文章
    	$result = DB::table('article')->where('id','=',$id)->where('article_type','=','article')->delete();
        //删除该篇文章的评论信息
        DB::table('comment')->where('article_id','=',$id)->delete();
    	//返回输出
    	return $result ? '1' : '0';
    }

    //招聘动态列表
    public function recruit(){
    	//查询数据
    	$data = DB::table('article')->where('article_type','=','recruit')->get();
    	//查询一些没有直接显示的数据，例如地点，类别
    	$length = count($data);
    	for($i = 0; $i < $length; $i++){
    		$province_id = $data[$i]->province_id;
    		$city_id = $data[$i]->city_id;
    		$category_id = $data[$i]->category_id;
    		//省份
    		$province = DB::table('area')->where('id','=',$province_id)->value('area');
    		//城市
    		$city = DB::table('area')->where('id','=',$city_id)->value('area');
    		//职能类别
    		$category = DB::table('category')->where('id','=',$category_id)->value('category_name');
    		//将这些数据放进data中
    		$data[$i]->province = $province;
    		$data[$i]->city = $city;
    		$data[$i]->category = $category;

    	}
    	//招聘动态数量
    	$tot = count($data);
    	//展示视图
    	return view('admin.article.recruit', compact('data','tot'));
    }

    //删除招聘动态
    public function del_rec(Request $request){
    	//文章id
    	$id = $request->id;
    	//从数据库中删除该文章
    	$result = DB::table('article')->where('id','=',$id)->where('article_type','=','recruit')->delete();
    	//返回输出
    	return $result ? '1' : '0';
    }
}

