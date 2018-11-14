<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //后台首页
    public function index(){
    	//展示后台首页
    	return view('admin.index.index');
    }

    //首页-框架页面
    public function welcome(){
    	return view('admin.index.welcome');
    }
}
