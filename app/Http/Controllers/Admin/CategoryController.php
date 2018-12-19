<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;

class CategoryController extends Controller
{
    //职能类别列表
    public function index(){
    	//查询数据
    	$data = DB::table('category')->get();
    	//展示视图
    	return view('admin.category.index', compact('data'));
    }

    //添加职能类别
    public function add(Request $request){
    	if(Input::method() == 'POST'){
    		//接收职能类别名称
    		$category_name = $request->category_name;
    		//插入数据库
    		$result = DB::table('category')->insert(['category_name'=>$category_name]);
    		//返回输出
    		return $result ? '1' : '0';
    	}else{
    		//展示视图
    		return view('admin.category.add');
    	}
    }

    //删除职能类别
    public function del(Request $request){
    	//接收id
    	$id = $request->id;
    	//从数据库中删除该职能类别
    	$result = DB::table('category')->where('id','=',$id)->delete();
    	//返回输出
    	return $result ? '1' : '0';
    }

}
