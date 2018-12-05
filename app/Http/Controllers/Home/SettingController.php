<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Session;

class SettingController extends Controller
{
    //个人设置首页
    public function index(){
    	//查询数据（国家的数据）
		$province = DB::table('area')->where('pid','1')->get();
		$category = DB::table('category')->get();
		if(Session::get('loginType') == 'member'){
			$id = Auth::guard('member')->user()->id;
			$is_recommend = DB::table('member')->where('id','=',$id)->value('is_recommend');
			//展示视图
    		return view('home.setting.index', compact('province', 'category', 'is_recommend'));
		}elseif(Session::get('loginType') == 'company'){
			//展示视图
	    	return view('home.setting.index', compact('province', 'category'));
		}
    	
    }

    //求职偏好设置
    public function expect(Request $request){
    	//接收数据
        //省份
        $province_id = $request->province_id;
        //城市
        $city_id = $request->city_id;
        //职能类别
        $category_id = $request->category_id;
        //职位性质
        $recruit_type = $request->recruit_type;
        //目前状态
        $status = $request->status;
        //用户id
        $user_id = Auth::guard('member')->user()->id;
        //判断该用户期望工作信息是否存在，存在的话则更新，不存在则插入
        $count = DB::table('expectation')->where('user_id','=',$user_id)->count();
        if($count > 0){
            //更新数据
            $result = DB::table('expectation')->where('user_id','=',$user_id)->update([
                'province_id'   =>  $province_id,
                'city_id'       =>  $city_id,
                'category_id'   =>  $category_id,
                'recruit_type'  =>  $recruit_type,
                'status'        =>  $status
            ]);
        }else{
            //数据入库
            $result = DB::table('expectation')->insert([
                'province_id'   =>  $province_id,
                'city_id'       =>  $city_id,
                'category_id'   =>  $category_id,
                'recruit_type'  =>  $recruit_type,
                'status'        =>  $status,
                'user_id'       =>  $user_id
            ]);
        }
        //返回输出
        return $result ? $user_id : '0';
        
    }

    //打开/关闭是否被推荐
    public function tuijian(Request $request){
    	//接收命令（打开或者关闭）
    	$command = $request->command;
    	$id = Auth::guard('member')->user()->id;
    	if($command == 'on'){
    		//打开推荐
    		$result = DB::table('member')->where('id','=',$id)->update(['is_recommend'=>'2']);
    	}elseif($command == 'off'){
    		//关闭推荐
    		$result = DB::table('member')->where('id','=',$id)->update(['is_recommend'=>'1']);
    	}
    	// dd($result);
    	//返回输出
    	return $result ? '1' : '0';


    }



}
