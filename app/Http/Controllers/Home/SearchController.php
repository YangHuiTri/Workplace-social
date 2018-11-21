<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    //个人主页搜索
    public function index(){
    	//展示视图
    	return view('home.search.index');
    }
}
