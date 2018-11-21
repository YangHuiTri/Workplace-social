<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;

class ArticleController extends Controller
{
    //添加动态
    public function add(Request $request){
    	if(Input::method() == 'POST'){
    		// dd($request->file('picture'));
    		$request->file('picture')->move('./uploads/','123.jpg');
    		
    	}
    	//展示视图
    	return view('home.article.add');
    }
}
