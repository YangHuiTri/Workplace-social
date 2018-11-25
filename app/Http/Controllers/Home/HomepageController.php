<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Auth;

class HomepageController extends Controller
{
    //个人主页
    public function index(Request $request){
    	//接收用户id
    	$id = $request->id;
        $type = $request->type;
        if(Session::get('loginType') == 'company'){
            $login_id = Auth::guard('company')->user()->id;
        }elseif(Session::get('loginType') == 'member'){
            $login_id = Auth::guard('member')->user()->id;
        }
        // dd($type);
    	if($type == 'company'){
    		//在member表中查询地址信息
    		$res = DB::table('company')->where('id','=',$id)->get()->toArray();

    		$country_id = $res['0']->country_id;//国家id
    		$province_id = $res['0']->province_id;//省份id
    		$city_id = $res['0']->city_id;//城市id
    		$county_id = $res['0']->county_id;//县区id
    		//前往区域area表中查询地址名
    		$country = DB::table('area')->where('id','=',$country_id)->value('area');
    		$province = DB::table('area')->where('id','=',$province_id)->value('area');
    		$city = DB::table('area')->where('id','=',$city_id)->value('area');
    		$county = DB::table('area')->where('id','=',$county_id)->value('area');
    		//将地址存放进数组
    		$data = [
    			'country'	=>	$country,
    			'province'	=>	$province,
    			'city'		=>	$city,
    			'county'	=>	$county,
                'type'      =>  $type,
                'id'        =>  $id,
                'login_id'  =>  $login_id
    		];

            //个人动态数据
            $data2 = DB::table('article')->where('author_id','=',$login_id)->orderBy('created_at','desc')->get();
    		//展示视图
    		return view('home.homepage.index', compact('data','res','data2'));

    	}elseif($type == 'member'){
    		//在member表中查询地址信息
    		$res = DB::table('member')->where('id','=',$id)->get();

            //查询工作过的公司com_id对用的公司名，因为compamy表已经和member表中的school_id关联了，所以这里没办法再用关联模型，com_id和school_id同在member表中
            $com_id = $res['0']->com_id;
            $company_name = DB::table('company')->where('id','=',$com_id)->value('com_name');
            //查询学校信息(后来我发现即使com_id和school_id关联了也不好使，因为当别人访问你的主页时，你的没登录，关联模型用不了)
            $school_id = $res['0']->school_id;
            $school = DB::table('company')->where('id','=',$school_id)->value('com_name');


    		$country_id = $res['0']->country_id;//国家id
    		$province_id = $res['0']->province_id;//省份id
    		$city_id = $res['0']->city_id;//城市id
    		$county_id = $res['0']->county_id;//县区id
    		//前往区域area表中查询地址名
    		$country = DB::table('area')->where('id','=',$country_id)->value('area');
    		$province = DB::table('area')->where('id','=',$province_id)->value('area');
    		$city = DB::table('area')->where('id','=',$city_id)->value('area');
    		$county = DB::table('area')->where('id','=',$county_id)->value('area');
    		//将地址存放进数组
    		$data = [
    			'country'	=>	$country,
    			'province'	=>	$province,
    			'city'		=>	$city,
    			'county'	=>	$county,
                'type'      =>  $type,
                'id'        =>  $id,
                'login_id'  =>  $login_id,
                'company_name'=>$company_name,
                'com_id'    =>  $com_id,
                'school'    =>  $school,
                'school_id' =>  $school_id
    		];

            //个人动态数据
            $data2 = DB::table('article')->where('author_id','=',$login_id)->orderBy('created_at','desc')->get();
    		//展示视图
    		return view('home.homepage.index', compact('data','res','data2'));
    	}
    	
    }
}
