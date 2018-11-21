<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入模型
use App\Admin\Member;
use App\Admin\Company;
use Session;
use DB;
use Input;

class EditController extends Controller
{
    //编辑信息
    public function index(Request $request){
    	//接收id
    	$id = $request->id;
    	//需要编辑的类型（企业company/用户member）
    	$type = $request->type;

    	if(Input::method() == 'POST'){
    		//实现数据的保存

    		if($type == 'member'){
	            //自动验证数据各字段
	            $this->validate($request,[
	            	'username'	=>		'required|min:2|max:20',
	            	'gender'	=>		'required',
	                'mobile'    =>      'regex:/^1[34578][0-9]{9}$/',
	                'country_id'=>		'required',
	                'province_id'=>		'required',
	                'education'	=>		'required',
	                'com_id'	=>		'required',
	                'introduction'=>	'required|min:10|max:200',
	            ]);
    			//查询头像信息（修改之前存在头像但修改时没有上传新头像还是要显示旧头像）
    			$data = DB::table('member')->where('id','=',$id)->get();
    			$avatar = $data['0']->avatar;//原头像
    			//原地址信息
    			// if(Input::get('country_id') == '0'){
    			// 	$country_id = $data['0']->country_id;
	    		// 	$province_id = $data['0']->province_id;
	    		// 	$city_id = $data['0']->city_id;
	    		// 	$county_id = $data['0']->county_id;
    			// }else{
    			// 	$country_id = Input::get('country_id');
	    		// 	$province_id = Input::get('country_id');
	    		// 	$city_id = Input::get('country_id');
	    		// 	$county_id = Input::get('country_id');
    			// }
    			
    // 			//学历
    // 			$education = $data['0']->education;
				// //毕业院校
    // 			$school_id = $data['0']->school_id;
    // 			//就业公司
    // 			$com_id = $data['0']->com_id;
    			
	    		$result = Member::where('id','=',$id)->update([
    				'username'		=>		Input::get('username'),
    				'gender'		=>		Input::get('gender'),
    				'mobile'		=>		Input::get('mobile'),
    				'avatar'		=>		Input::get('avatar')?Input::get('avatar'):$avatar,
    				'country_id'	=>		Input::get('country_id'),
    				'province_id'	=>		Input::get('province_id'),
    				'city_id'		=>		Input::get('city_id'),
    				'county_id'		=>		Input::get('county_id'),
    				'status'		=>		Input::get('status'),
    				'updated_at'	=>		date('Y-m-d H:i:s'),
    				'education'		=>		Input::get('education'),
    				'school_id'		=>		Input::get('school_id'),
    				'com_id'		=>		Input::get('com_id'),
    				'introduction'	=>		Input::get('introduction'),
    				'status'		=>		'2',
	    		]);
	    		//返回输出
	    		return $result ? $id : '0';
    		}elseif($type == 'company'){
	            //自动验证数据各字段
	            $this->validate($request,[
	            	'com_name'	=>		'required|min:2|max:20',
	                'mobile'    =>      'regex:/^1[34578][0-9]{9}$/',
	                'emp_count'	=>		'required',
	                'country_id'=>		'required',
	                'province_id'=>		'required',
	                'introduction'=>	'required|min:10|max:200',
	            ]);
    			//查询头像信息（修改之前存在头像但修改时没有上传新头像还是要显示旧头像）
    			$data = DB::table('company')->where('id','=',$id)->get();
    			$avatar = $data['0']->avatar;//原头像
    			//原地址信息
    			$country_id = $data['0']->country_id;
    			$province_id = $data['0']->province_id;
    			$city_id = $data['0']->city_id;
    			$county_id = $data['0']->county_id;
    			$result = Company::where('id','=',$id)->update([
    				'com_name'		=>		Input::get('com_name'),
    				'mobile'		=>		Input::get('mobile'),
    				'avatar'		=>		Input::get('avatar')?Input::get('avatar'):$avatar,
    				'country_id'	=>		Input::get('country_id')?Input::get('country_id'):$country_id,
    				'province_id'	=>		Input::get('province_id')?Input::get('province_id'):$province_id,
    				'city_id'		=>		Input::get('city_id')?Input::get('city_id'):$city_id,
    				'county_id'		=>		Input::get('county_id')?Input::get('county_id'):$county_id,
    				'updated_at'	=>		date('Y-m-d H:i:s'),
    				'emp_count'		=>		Input::get('emp_count'),
    				'introduction'	=>		Input::get('introduction')
    			]);
    			//返回输出
    			return $result ? $id : '0';
    		}

    	}
    	//查询数据（国家的数据）
		$country = DB::table('area')->where('pid','0')->get();
		//学校数据
		$data = DB::table('company')->where('com_type','=','2')->get();
		//公司数据
		$data2 = DB::table('company')->where('com_type','=','1')->get();
    	//展示视图
    	return view('home.edit.index', compact('country','data','data2','type','id'));
    }



    //ajax四级联动获取下属地区
    public function getAreaById(){
    	//接收id
    	$id = Input::get('id');
    	//根据id去查询下属地区
    	$data = DB::table('area')->where('pid',$id)->get();
    	//返回json数据
    	return response()->json($data);
    } 




}
