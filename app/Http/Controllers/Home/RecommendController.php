<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RecommendController extends Controller
{
    //职位推荐首页
    public function index(){
    	//展示视图
    	return view('home.recommend.index');
    }
}
