<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Input;

class IndexController extends Controller
{
    //首页
    public function index(){
    	//查询数据
    	$data = DB::table('article')->get();
    	//展示首页视图
    	return view('home.index.index', compact('data'));
    }

}
