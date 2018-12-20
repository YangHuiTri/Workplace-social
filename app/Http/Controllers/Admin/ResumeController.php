<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ResumeController extends Controller
{
    //履历列表
    public function index(){
    	//查询数据
    	$data = DB::table('resume')->orderBy('user_id','asc')->get();
    	//履历总数量
    	$tot = count($data);
    	//查询简历作者
    	for($i = 0; $i < $tot; $i++){
    		$data[$i]->author_name = DB::table('member')->where('id','=',$data[$i]->user_id)->value('username');
    	}
    	//展示视图
    	return view('admin.resume.index', compact('data','tot'));
    }

    //删除履历
    public function del(Request $request){
    	//履历id
    	$id = $request->id;
    	//从数据库中删除该履历
    	$result = DB::table('resume')->where('id','=',$id)->delete();
    	//返回输出
    	return $result ? '1' : '0';
    }

}
