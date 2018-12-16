<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Auth;
//引入模型
use App\Home\Resume;

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
            $data2 = DB::table('article')->where('author_id','=',$id)->orderBy('created_at','desc')->get();
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
            $data2 = DB::table('article')->where('author_id','=',$id)->orderBy('created_at','desc')->get();
    		//展示视图
    		return view('home.homepage.index', compact('data','res','data2'));
    	}
    	
    }

    //个人履历
    public function resume(Request $request){
        //用户id
        $id = $request->id;
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
            'country'   =>  $country,
            'province'  =>  $province,
            'city'      =>  $city,
            'county'    =>  $county,
            'company_name'=>$company_name,
            'com_id'    =>  $com_id,
            'school'    =>  $school,
        ];
        //查询教育背景
        $education = DB::table('resume')->where('user_id','=',$id)->where('type','=','education')->orderBy('start_time','desc')->get();
        //查询工作经验
        $work = DB::table('resume')->where('user_id','=',$id)->where('type','=','work')->orderBy('start_time','desc')->get();
        //查询项目经验
        $project = DB::table('resume')->where('user_id','=',$id)->where('type','=','project')->orderBy('start_time','desc')->get();
        //查询专业技能
        $skill = DB::table('resume')->where('user_id','=',$id)->where('type','=','skill')->orderBy('start_time','desc')->get();
        //查询相关证书
        $certificate = DB::table('resume')->where('user_id','=',$id)->where('type','=','certificate')->orderBy('created_at','Asc')->get();
        //展示视图
        return view('home.homepage.resume', compact('res','data','project','work','education','skill','certificate'));
    }

    //添加工作经验
    public function addResume(Request $request){
        // 接收数据
        //履历种类
        $type = $request->type;
        //开始时间
        $start_time = $request->start_time;
        //结束时间
        $end_time = $request->end_time;
        //名称
        $title = $request->title;
        //描述
        //替换空格和换行
        $pattern = array('/ /','/　/','/\r\n/','/\n/');
        $replace = array('&nbsp;','&nbsp;','<br/>','<br/>');
        $content = preg_replace($pattern, $replace, $request->content);
        //职责
        $duty = $request->duty;
        //用户id
        $user_id = Auth::guard('member')->user()->id;
        if($type == 'project'){
            //新增项目经验
            //验证字段
            $this->validate($request,[
                'start_time' => 'required',
                'end_time' => 'required',
                'title' => 'required',
                'duty' => 'required',
                'type' => 'required',
                'content' => 'required'
            ]);
            //数据入库
            $result = Resume::create([
                'start_time' => $start_time,
                'end_time'   => $end_time,
                'title'      => $title,
                'duty'       => $duty,
                'type'       => $type,
                'content'    => $content,
                'user_id'    => $user_id
            ]);
            //返回输出
            return $result ? '1' : '0';
        }elseif($type == 'work'){
            //新增工作经验
            //验证字段
            $this->validate($request,[
                'start_time' => 'required',
                'end_time' => 'required',
                'title' => 'required',
                'duty' => 'required',
                'type' => 'required',
                'content' => 'required'
            ]);
            //数据入库
            $result = Resume::create([
                'start_time' => $start_time,
                'end_time'   => $end_time,
                'title'      => $title,
                'duty'       => $duty,
                'type'       => $type,
                'content'    => $content,
                'user_id'    => $user_id
            ]);
            //返回输出
            return $result ? '1' : '0';
        }elseif($type == 'education'){
            //新增教育背景
            //验证字段
            $this->validate($request,[
                'start_time' => 'required',
                'end_time' => 'required',
                'title' => 'required',
                'type' => 'required',
            ]);
            //数据入库
            $result = Resume::create([
                'start_time' => $start_time,
                'end_time'   => $end_time,
                'title'      => $title,
                'type'       => $type,
                'user_id'    => $user_id
            ]);
            //返回输出
            return $result ? '1' : '0';
        }elseif($type == 'skill'){
            //新增专业技能
            //验证字段
            $this->validate($request,[
                'start_time' => 'required',
                'end_time' => 'required',
                'title' => 'required',
                'type' => 'required',
                'content' => 'required'
            ]);
            //数据入库
            $result = Resume::create([
                'start_time' => $start_time,
                'end_time'   => $end_time,
                'title'      => $title,
                'type'       => $type,
                'content'    => $content,
                'user_id'    => $user_id
            ]);
            //返回输出
            return $result ? '1' : '0';
        }elseif ($type == 'certificate') {
            //新增相关证书
            //验证字段
            $this->validate($request,[
                'title' => 'required',
                'type' => 'required'
            ]);
            //数据入库
            $result = Resume::create([
                'title'      => $title,
                'type'       => $type,
                'user_id'    => $user_id
            ]);
            //返回输出
            return $result ? '1' : '0';
        }
        
    }










}
