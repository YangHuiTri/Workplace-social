<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入模型
use App\Admin\Manager;
use DB;

class ManagerController extends Controller
{
    //管理员列表
    public function index(){
    	//查询数据
    	$data = Manager::get();
    	//查询数据总数
    	$count = DB::table('manager')->count();
    	//展示视图
    	return view('admin.manager.index', compact('data','count'));

    }

    //停用管理员
    public function stop(Request $request){
    	//接收需要停用的管理员id
    	$id = $request->id;
    	//修改管理员数据状态
    	$result = Manager::where('id',$id)->update(['status'=>'1']);
    	if($result){
    		return 1;
    	}else{
    		return 0;
    	}
    }

    //启用管理员
    public function start(Request $request){
    	//接收需要启用的管理员id
    	$id = $request->id;
    	//修改管理员数据状态
    	$result = Manager::where('id',$id)->update(['status'=>'2']);
    	if($result){
    		return 1;
    	}else{
    		return 0;
    	}    	
    }

    //删除管理员
    public function del(Request $request){
    	//接收管理员id
    	$id = $request->id;
    	//删除管理员
    	$result = Manager::where('id',$id)->delete();
    	if($result){
    		return 1;
    	}else{
    		return 0;
    	}
    }




}
