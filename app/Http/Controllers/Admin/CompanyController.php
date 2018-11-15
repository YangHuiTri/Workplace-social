<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入模型
use App\Admin\Company;

class CompanyController extends Controller
{
    //企业列表
    public function index(){
    	//查询数据
    	$data = Company::get();
    	//展示视图
    	return view('admin.company.index', compact('data'));
    }

    //删除企业
    public function del(Request $request){
    	//接收企业id
    	$id = $request->id;
    	//从数据库中删除该企业
    	$result = Company::where('id', $id)->delete();
    	if($result){
    		return 1;//删除成功
    	}else{
    		return 0;//删除失败
    	}
    }
}
