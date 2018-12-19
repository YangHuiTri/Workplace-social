<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//引入模型
use App\Admin\Company;
use Input;
use DB;

class CompanyController extends Controller
{
    //企业列表
    public function index(){
    	//查询数据
    	$data = Company::get();
        //总数量
        $tot = count($data);
    	//展示视图
    	return view('admin.company.index', compact('data','tot'));
    }

    //添加企业
    public function add(Request $request){
        if(Input::method() == 'POST'){
            //自动验证数据各字段
            $this->validate($request,[
                'com_name'  =>      'required|min:2|max:20',
                'email'     =>      'email|unique:company,email',
                'mobile'    =>      'regex:/^1[34578][0-9]{9}$/|unique:company,mobile',
            ]);
            //数据入库
            $result = Company::insert([
                'com_name'      =>      Input::get('com_name'),
                'password'      =>      bcrypt('123456'),
                'mobile'        =>      Input::get('mobile'),
                'email'         =>      Input::get('email'),
                'avatar'        =>      '/statics/avatar.jpg',
                'country_id'    =>      Input::get('country_id'),
                'province_id'   =>      Input::get('province_id'),
                'city_id'       =>      Input::get('city_id'),
                'county_id'     =>      Input::get('county_id'),
                'com_type'      =>      Input::get('com_type'),
                'emp_count'     =>      '0',
                'introduction'  =>      '暂无简介',
            ]);
            //返回输出
            return $result ? '1' : '0';
        }else{
            //查询数据（国家的数据）
            $country = DB::table('area')->where('pid','0')->get();
            //展示视图
            return view('admin.company.add', compact('country')); 
        } 
    }

    //停用企业
    public function stop(Request $request){
        //接收要禁用的用户id
        $id = $request->id;
        //从数据库禁用该用户
        $result = DB::table('company')->where('id','=',$id)->update(['status'=>'1']);
        //返回输出
        return $result ? '1' : '0';
    }

    //启用企业
    public function start(Request $request){
        //接收用户id
        $id = $request->id;
        //从数据库启用该用户
        $result = DB::table('company')->where('id','=',$id)->update(['status'=>'2']);
        //返回输出
        return $result ? '1' : '0';
    }

    //删除企业
    public function del(Request $request){
    	//接收企业id
    	$id = $request->id;
    	//从数据库中删除该企业
    	$result = Company::where('id', $id)->delete();
    	if($result){
    		return 1;//删除成功
    	}else{
    		return 0;//删除失败
    	}
    }
}
