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
    	//接收用户id
    	$id = $request->id;
    	//需要编辑的类型（企业company/用户member）
    	$type = $request->type;

    	if(Input::method() == 'POST'){
    		//实现数据的保存

    		if($type == 'member'){
	            //自动验证数据各字段
	            $this->validate($request,[
	            	'username'	=>		'required|min:2|max:20',
                    'age'       =>      'required',
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
    			
     			//学历
     			//$education = $data['0']->education;
				// //毕业院校
     			//$school_id = $data['0']->school_id;
     			//就业公司
    			//$com_id = $data['0']->com_id;

                # 替换空格和换行
                $pattern = array('/ /','/　/','/\r\n/','/\n/');
                $replace = array('&nbsp;','&nbsp;','<br/>','<br/>');
                $introduction = preg_replace($pattern, $replace, Input::get('introduction'));
    			
	    		$result = Member::where('id','=',$id)->update([
    				'username'		=>		Input::get('username'),
                    'age'           =>      Input::get('age'),
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
                    'profession'    =>      Input::get('profession'),
                    'school_validate'=>     '1',
    				'com_id'		=>		Input::get('com_id'),
    				'introduction'	=>		$introduction,
    				'status'		=>		'2',
	    		]);

                $school_id = Input::get('school_id');
                $validate = DB::table('company')->where('id','=',$school_id)->value('need_validate');
                $need_validate = $id.','.$validate;
                DB::table('company')->where('id','=',$school_id)->update(['need_validate'=>$need_validate]);

                //更新动态中的图片（此时修改个人资料，头像被改后动态的头像不会更新，除非重新发新动态，所以这里要更新一下动态里面作者的头像）
                $author_avatar = Member::where('id','=',$id)->value('avatar');
                $author_name = Member::where('id','=',$id)->value('username');
                DB::table('article')->where('author_id','=',$id)->update([
                    'author_avatar' => $author_avatar,
                    'author_name'   => $author_name
                ]);
                //同样评论表中也要做如上处理
                DB::table('comment')->where('author_id','=',$id)->update([
                    'author_avatar' => $author_avatar,
                    'author_name'   => $author_name
                ]);

                //一开始选择学校后没有经过认证，自动给学校发信息请求认证，所以学校的message_count字段需要加1,（本科以上才需要选大学）
                $education = Input::get('education');
                if($education >= 3){
                    $count = DB::table('company')->where('id','=',$school_id)->value('message_count');
                    $message_count = $count + 1;
                    DB::table('company')->where('id','=',$school_id)->update(['message_count'=>$message_count]);
                }


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
                // dd(Input::get('county_id'));
    			//原地址信息
    			// $country_id = $data['0']->country_id;
    			// $province_id = $data['0']->province_id;
    			// $city_id = $data['0']->city_id;
    			// $county_id = $data['0']->county_id;

                # 替换空格和换行
                $pattern = array('/ /','/　/','/\r\n/','/\n/');
                $replace = array('&nbsp;','&nbsp;','<br/>','<br/>');
                $introduction = preg_replace($pattern, $replace, Input::get('introduction'));

    			$result = Company::where('id','=',$id)->update([
    				'com_name'		=>		Input::get('com_name'),
    				'mobile'		=>		Input::get('mobile'),
    				'avatar'		=>		Input::get('avatar')?Input::get('avatar'):$avatar,
    				'country_id'	=>		Input::get('country_id'),
    				'province_id'	=>		Input::get('province_id'),
    				'city_id'		=>		Input::get('city_id'),
    				'county_id'		=>		Input::get('county_id'),
    				'updated_at'	=>		date('Y-m-d H:i:s'),
    				'emp_count'		=>		Input::get('emp_count'),
    				'introduction'	=>		$introduction
    			]);

                //更新动态中的图片（此时修改个人资料，头像被改后动态的头像不会更新，除非重新发新动态，所以这里要更新一下动态里面作者的头像）
                $author_avatar = Company::where('id','=',$id)->value('avatar');
                $author_name = Company::where('id','=',$id)->value('com_name');
                DB::table('article')->where('author_id','=',$id)->update([
                    'author_avatar' => $author_avatar,
                    'author_name'   => $author_name
                ]);
                //同样评论表中也要做如上处理
                DB::table('comment')->where('author_id','=',$id)->update([
                    'author_avatar' => $author_avatar,
                    'author_name'   => $author_name
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
