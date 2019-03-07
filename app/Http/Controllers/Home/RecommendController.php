<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class RecommendController extends Controller
{
    //职位推荐首页
    public function index(){
    	//查询数据
    	//用户id
    	$id = Auth::guard('member')->user()->id;
    	//查询该用户期望工作信息
    	$data = DB::table('expectation')->where('user_id','=',$id)->get();
        $length = count($data);
        if($length > 0){
            //期望工作省份
            $province_id = $data['0']->province_id;
            //期望工作城市
            $city_id = $data['0']->city_id;
            //期望职能类别（行业）
            $category_id = $data['0']->category_id;
            //期望职能性质
            $recruit_type = $data['0']->recruit_type;

            //查询符合要求的招聘信息
            $data2 = DB::table('article')->where('article_type','=','recruit')->where('category_id','=',$category_id)->orderBy('created_at','desc')->get();
            $length = count($data2);
            for($i = 0; $i < $length; $i++){
                $data2[$i]->work_province = DB::table('area')->where('id','=',$data2[$i]->province_id)->value('area');
                $data2[$i]->work_city = DB::table('area')->where('id','=',$data2[$i]->city_id)->value('area');
            }
        }else{
            $data2 = '';
        }
    	
    	// dd($data2);
    	// dd($data['0']->province_id);
    	//展示视图
    	return view('home.recommend.index',compact('data2'));
    }
}
