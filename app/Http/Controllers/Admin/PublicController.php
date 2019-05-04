<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use DB;

class PublicController extends Controller
{
    //后台登录
    public function login(){
    	//展示视图
    	return view('admin.public.login');
    }

    //验证数据
    public function check(Request $request){
    	//开始自动验证
    	$this->validate($request,[
    		'username'	=>	'required|min:2|max:20',	//用户名，必填，长度介于2-20
    		'password'	=>	'required|min:6',	//密码，必填，长度至少为6
    		'captcha'	=>	'required|size:5|captcha'	//验证码，必填，长度等于5，必须是合法的验证码
    	]);
    	//继续开始进行身份核实
    	$data = $request -> only(['username','password']);
    	$data['status'] = '2';	//要求状态为启用的用户
    	$result = Auth::guard('admin')->attempt($data,$request->get('online'));
    	//判断是否成功
    	if($result){
    		//跳转到后台页面
    		return redirect('/admin/index/index');
    	}else{
    		//跳到登录页
    		return redirect('/admin/public/login')->withErrors([
    			'loginError'	=>	'用户名或密码错误或账号状态非法'
    		]);
    	}
    }

    //退出登录
    public function logout(){
    	Auth::guard('admin')->logout();
    	//跳转回登录页面
    	return redirect('/admin/public/login');

    }

    //注册统计图
    public function charts(){
        //查询数据
        // $data = DB::table('member')->select(DB::Raw('count(*) as cont'))->groupBy(month(created_at))->get();
        $data = DB::select("SELECT DATE_FORMAT(created_at,'%Y-%m') as time,count(*) as cont FROM member GROUP BY time");//普通用户注册量
        for ($i=0; $i < count($data); $i++) { 
            $cont[$i] = $data[$i]->cont;
            $time[$i] = $data[$i]->time;
        }
        $data2 = json_encode($data);
        $cont2 = json_encode($cont);
        $time2 = json_encode($time);

        $data3 = DB::select("SELECT DATE_FORMAT(created_at,'%Y-%m') as time,count(*) as cont FROM company GROUP BY time");//企业用户注册量
        for ($i=0; $i < count($data3); $i++) { 
            $cont3[$i] = $data3[$i]->cont;
            $time3[$i] = $data3[$i]->time;
        }
        $data4 = json_encode($data3);
        $cont4 = json_encode($cont3);
        $time4 = json_encode($time3);
        // dd($arr);
        // $data = DB::table('member as t1')->select('t2.area as name',DB::Raw('count(*) as value'))->leftJoin('area as t2', 't1.province_id', '=', 't2.id')->where('t1.com_id','=',$id)->groupBy('t2.area')->get();
        //展示视图
        return view('admin.public.charts',compact('data2','cont2','time2','data4','cont4','time4'));
    }

    //职位统计图
    public function charts2(){
        //查询数据
        // $data = DB::select("SELECT count(*) cont,date(created_at) as date from `article` where datediff(now(),created_at)<=6 and article_type='recruit'  group by day(created_at)");
        $sql = "SELECT a.click_date,ifnull(b.count,0) as count
                from (
                SELECT curdate() as click_date
                union all
                SELECT date_sub(curdate(), interval 1 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 2 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 3 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 4 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 5 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 6 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 7 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 8 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 9 day) as click_date
                ) a left join (
                select date(created_at) as datetime, count(*) as count
                from article where article_type='recruit'
                group by date(created_at)
                ) b on a.click_date = b.datetime";
        $data = DB::select($sql);
        $data = array_reverse($data);
        // dd($data);
        for ($i=0; $i < count($data); $i++) { 
            $cont[$i] = $data[$i]->count;
            $time[$i] = $data[$i]->click_date;
        }
        $data2 = json_encode($data);
        $cont2 = json_encode($cont);
        $time2 = json_encode($time);
        // dd($data);
        //展示视图
        return view('admin.public.charts2',compact('data2','cont2','time2'));
    }

    //动态统计图
    public function charts3(){
        //查询数据
        $sql = "SELECT a.click_date,ifnull(b.count,0) as count
                from (
                SELECT curdate() as click_date
                union all
                SELECT date_sub(curdate(), interval 1 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 2 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 3 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 4 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 5 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 6 day) as click_date
                ) a left join (
                select date(created_at) as datetime, count(*) as count
                from article where article_type='article' and author_type='company'
                group by date(created_at)
                ) b on a.click_date = b.datetime";
        $data = DB::select($sql);
        $data = array_reverse($data);
        // dd($data);
        for ($i=0; $i < count($data); $i++) { 
            $cont[$i] = $data[$i]->count;
            $time[$i] = $data[$i]->click_date;
        }
        $data2 = json_encode($data);
        $cont2 = json_encode($cont);
        $time2 = json_encode($time);


        $sql = "SELECT a.click_date,ifnull(b.count,0) as count
                from (
                SELECT curdate() as click_date
                union all
                SELECT date_sub(curdate(), interval 1 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 2 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 3 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 4 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 5 day) as click_date
                union all
                SELECT date_sub(curdate(), interval 6 day) as click_date
                ) a left join (
                select date(created_at) as datetime, count(*) as count
                from article where article_type='article' and author_type='member'
                group by date(created_at)
                ) b on a.click_date = b.datetime";
        $data3 = DB::select($sql);
        $data3 = array_reverse($data3);
        // dd($data);
        for ($i=0; $i < count($data3); $i++) { 
            $cont3[$i] = $data3[$i]->count;
            $time3[$i] = $data3[$i]->click_date;
        }
        $data4 = json_encode($data3);
        $cont4 = json_encode($cont3);
        $time4 = json_encode($time3);
        // dd($time2,$cont2,$cont4);

        //展示视图
        return view('admin.public.charts3',compact('cont2','time2','cont4'));
    }



}
