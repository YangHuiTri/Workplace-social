<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use Auth;

class MessageController extends Controller
{
    //message首页
    public function index(Request $request){
    	//接收用户/公司id
    	$id = $request->id;
    	//接收用户类型
    	$type = $request->type;
    	if($type == 'company'){
    		//（一）处理公司的认证消息
    		$need_validate = DB::table('company')->where('id','=',$id)->value('need_validate');
    		$validate = rtrim($need_validate,',');
    		$arr = explode(',', $validate);
    		$length = count($arr);
    		for($i = 0;$i < $length; $i++){
    			$data[] = $this->member_name($arr[$i]);
    		}
            //是否接收求职信息
            $is_receive = DB::table('company')->where('id','=',$id)->value('is_receive');

    		//（二）处理公司的动态消息
    		//点赞信息部分
    		//先查询该公司用户的所有文章
    		$data2 = DB::table('article')->where('author_id','=',$id)->where('author_type','=','company')->get();
    		// dd($data2);
    		// dd($data2['0']->message_zan);
    		$length2 = count($data2);
    		$k = 0;
    		$p = 0;
    		$a = 0;
    		$b = 0;
    		$res = Array(Array());
    		// dd($res['0']);
    		//循环遍历每篇文章，查询文章id，content，以及点赞的人的类型type及id
    		for($i = 0; $i < $length2; $i++){
    			if(!empty($data2[$i]->message_zan)){
    				$res[$a++] = DB::table('article')->where('id','=',$data2[$i]->id)->get();
    			}
    		}
    		$length3 = count($res);
    		if(!empty($res['0'])){
    			for($b = 0; $b < $length3; $b++){
	    			//文章中最新点赞的人的类型和id集合（字段message_zan）
					$message_zan[] = explode(',', rtrim($res[$b]['0']->message_zan,','));
					for($j = 0; $j < count($message_zan[$b]); $j++){
	    				$arr2[] = explode('@', $message_zan[$b][$j]);//点赞者的类型及id
	    				$arr2[$k++]['3'] = $res[$b]['0']->id;//$arr[]['2']文章id
	    				$arr2[$p++]['4'] = $res[$b]['0']->content;//$arr[]['3']文章内容
	    			}	
	    		}
	    		//查询每个点赞人的用户名
	    		$n = 0;
	    		for($m = 0; $m < count($arr2); $m++){
	    			if($arr2[$m]['0'] == 'company'){
	    				$res2[] = DB::table('company')->where('id','=',$arr2[$m]['1'])->get();
	    				$arr2[$n++]['5'] = $res2[$m]['0']->com_name;//$arr[]['4']点赞者的用户名
	    			}elseif($arr2[$m]['0'] == 'member'){
	    				$res2[] = DB::table('member')->where('id','=',$arr2[$m]['1'])->get();
	    				$arr2[$n++]['5'] = $res2[$m]['0']->username;//$arr[]['4']点赞者的用户名
	    			}	
				}
			}

			//评论信息部分
			//循环遍历每篇文章，查询文章评论信息（message_com字段）
			$res4 = Array(Array());
			$z = 0;
    		for($i = 0; $i < $length2; $i++){
    			if(!empty($data2[$i]->message_com)){
    				$res4[$z++] = DB::table('article')->where('id','=',$data2[$i]->id)->get();
    			}
    		}
    		$length4 = count($res4);
    		// dd($res4);
    		// dd($length4);
    		if(!empty($res4['0'])){
    			for($y = 0; $y < $length4; $y++){
	    			//文章中最新评论的人的类型和id集合（字段message_com）
					$message_com[] = explode('$$$', rtrim($res4[$y]['0']->message_com,'$$$'));
					for($j = 0; $j < count($message_com[$y]); $j++){
	    				$arr4[] = explode('#@', $message_com[$y][$j]);//评论者的信息
	    			}
	    		}
    		}
    		// dd($message_com);
    		// dd($arr4);

            //（三）处理公司的职位申请信息
            //先查询该用户所有招聘动态
            $data3 = DB::table('article')->where('author_id','=',$id)->where('article_type','=','recruit')->get();
            // dd($data3);
            $arr6 = Array(Array());
            $k=0;
            for($i = 0; $i < count($data3); $i++){
                if(!empty($data3[$i]->recruit_people)){
                    //招聘职位
                    $recruit_title = $data3[$i]->recruit_title;//即arr6[]['2']
                    //招聘信息id
                    $recruit_id = $data3[$i]->id;//即arr6[]['3']
                    $arr5 = explode(',', rtrim($data3[$i]->recruit_people,','));
                    // dd($arr5);
                    for($j = 0; $j < count($arr5); $j++){
                        $arr6[$k] = explode('@', $arr5[$j]);
                        $username = DB::table('member')->where('id','=',$arr6[$k]['0'])->value('username');
                        // dd($arr6);
                        array_push($arr6[$k], $username);
                        array_push($arr6[$k], $recruit_title);
                        array_push($arr6[$k], $recruit_id);
                        $k++;
                    }  
                }  
            }
            $recruit_cont = count($arr6);
            // dd($recruit_cont);
            // dd($arr6);
    		//展示视图
    		return view('home.message.index',compact('data','type','id','arr2','arr4','arr6','recruit_cont','is_receive'));
    	}elseif($type == 'member'){
    		//处理用户的动态消息
    		//点赞部分
    		//先查询该用户的所有文章
    		$data2 = DB::table('article')->where('author_id','=',$id)->where('author_type','=','member')->get();
    		// dd($data2);
    		$length2 = count($data2);
    		$k = 0;
    		$p = 0;
    		$a = 0;
    		$b = 0;
    		$res = Array(Array());
    		// dd(count($res));
    		//循环遍历每篇文章，查询文章id，content，以及点赞的人的类型type及id
    		for($i = 0; $i < $length2; $i++){
    			if(!empty($data2[$i]->message_zan)){
    				$res[$a++] = DB::table('article')->where('id','=',$data2[$i]->id)->get();
    			}
    		}
    		// dd($res);
    		$length3 = count($res);
    		if(!empty($res['0'])){
    			for($b = 0; $b < $length3; $b++){
	    			//文章中最新点赞的人的类型和id集合（字段message_zan）
					$message_zan[] = explode(',', rtrim($res[$b]['0']->message_zan,','));
					for($j = 0; $j < count($message_zan[$b]); $j++){
	    				$arr2[] = explode('@', $message_zan[$b][$j]);//点赞者的类型及id
	    				$arr2[$k++]['3'] = $res[$b]['0']->id;//$arr[]['2']文章id
	    				$arr2[$p++]['4'] = $res[$b]['0']->content;//$arr[]['3']文章内容
	    			}	
	    		}
	    		//查询每个点赞人的用户名
	    		$n = 0;
	    		// dd($arr2);
	    		for($m = 0; $m < count($arr2); $m++){
	    			if($arr2[$m]['0'] == 'company'){
	    				$res2[] = DB::table('company')->where('id','=',$arr2[$m]['1'])->get();
	    				$arr2[$n++]['5'] = $res2[$m]['0']->com_name;//$arr[]['4']点赞者的用户名
	    			}elseif($arr2[$m]['0'] == 'member'){
	    				$res2[] = DB::table('member')->where('id','=',$arr2[$m]['1'])->get();
	    				$arr2[$n++]['5'] = $res2[$m]['0']->username;//$arr[]['4']点赞者的用户名
	    			}	
				}
    		}

    		//评论信息部分
			//循环遍历每篇文章，查询文章评论信息（message_com字段）
			$res4 = Array(Array());
			$z = 0;
    		for($i = 0; $i < $length2; $i++){
    			if(!empty($data2[$i]->message_com)){
    				$res4[$z++] = DB::table('article')->where('id','=',$data2[$i]->id)->get();
    			}
    		}
    		$length4 = count($res4);
    		// dd($res4);
    		if(!empty($res4['0'])){
    			for($y = 0; $y < $length4; $y++){
	    			//文章中最新评论的人的类型和id集合（字段message_com）
					$message_com[] = explode('$$$', rtrim($res4[$y]['0']->message_com,'$$$'));
					for($j = 0; $j < count($message_com[$y]); $j++){
	    				$arr4[] = explode('#@', $message_com[$y][$j]);//评论者的信息
	    				// $arr2[$k++]['2'] = $res[$b]['0']->id;//$arr[]['2']文章id
	    				// $arr2[$p++]['3'] = $res[$b]['0']->content;//$arr[]['3']文章内容
	    			}
	    		}
    		}
    		// dd($message_com);
    		// dd($arr4);
            $recruit_cont = 0;
			//展示视图
    		return view('home.message.index', compact('type','id','arr2','arr4','recruit_cont'));
    	}

    	
    }

    //实时获取未读消息数
    public function getCount(){
        if(Session::get('loginType')=='company'){
            //企业登录
            //企业id
            $id = Auth::guard('company')->user()->id;
            //查询该用户消息数
            $count = DB::table('company')->where('id', '=', $id)->value('message_count');
            echo empty($count) ? '0' : $count;
        }elseif(Session::get('loginType') == 'member'){
            //普通用户登录
            //用户id
            $id = Auth::guard('member')->user()->id;
            //查询该用户的消息数
            $count = DB::table('member')->where('id', '=', $id)->value('message_count');
            echo empty($count) ? '0' : $count;
        }
    }


    //查询用户信息(用于index方法中学校认证信息)
    public function member_name($id){
    	$data = DB::table('member')->where('id','=',$id)->get();
    	return $data;
    }


    //学校认证
    public function renzheng(Request $request){
    	//学校id
    	$com_id = $request->com_id;
    	//学生id
    	$user_id = $request->user_id;
    	//1、先查询该学校需要认证的的学生id集合
    	$data = DB::table('company')->where('id','=',$com_id)->get();
    	//2、将该认证的用户id从中删除
    	$need_validate = str_replace($user_id.',', '', $data['0']->need_validate);
    	//3、将公司未读信息数减1
    	$count = $data['0']->message_count;
    	$message_count = $count - 1;
    	//4、更新该公司的数据库
    	$result = DB::table('company')->where('id','=',$com_id)->update([
    		'need_validate'=>$need_validate,
    		'message_count'=>$message_count
    	]);
    	//5、更新用户数据库为已认证
    	DB::table('member')->where('id','=',$user_id)->update(['school_validate'=>2]);
    	//返回输出
    	return $result ? '1' : '0';
    }

    //清除点赞和评论消息
    public function chakan(Request $request){
        $cont = $request->recruit_cont;
    	//用户/公司id
    	if(Session::get('loginType') == 'company'){
    		$id = Auth::guard('company')->user()->id;
    		$data = DB::table('article')->where('author_id','=',$id)->where('author_type','=','company')->get();
    		$length = count($data);
    		// dd($data);
    		//清除该用户下全部文章的message_com和message_zan字段
    		for($i = 0; $i < $length; $i++){
    			DB::table('article')->where('id','=',$data[$i]->id)->update([
    				'message_com'	=>	'',
    				'message_zan'	=>	''
    			]);
    		}
    		//更新用户的信息数message_count字段（思路：只留下需要认证信息的个数）
    		//先查询该公司company表中的need_validate字段
    		$need_validate = DB::table('company')->where('id','=',$id)->value('need_validate');
    		if(!empty($need_validate)){
    			$validate = explode(',', rtrim($need_validate,','));
    			$message_count = count($validate)+$cont;
    			$result = DB::table('company')->where('id','=',$id)->update(['message_count'=>$message_count]);
    		}else{
    			$result = DB::table('company')->where('id','=',$id)->update(['message_count'=>$cont]);
    		}
    		//返回输出
    		return $result ? '1' : '0';
    	}elseif(Session::get('loginType') == 'member'){
    		$id = Auth::guard('member')->user()->id;
    		$data = DB::table('article')->where('author_id','=',$id)->where('author_type','=','member')->get();
    		$length = count($data);
    		// dd($data);
    		//清除该用户下全部文章的message_com和message_zan字段
    		for($i = 0; $i < $length; $i++){
    			DB::table('article')->where('id','=',$data[$i]->id)->update([
    				'message_com'	=>	'',
    				'message_zan'	=>	''
    			]);
    		}
    		//更新用户的信息数message_count字段（思路：清0）
    		$result = DB::table('member')->where('id','=',$id)->update(['message_count'=>'0']);
    		//返回输出
    		return $result ? '1' : '0';

    	}
    }

    //清除申请信息
    public function qingchu(Request $request){
        //公司id
        $id = Auth::guard('company')->user()->id;
        //需要清除的数量
        $cont = $request->cont;
        //清除招聘动态中的申请人信息
        $result = DB::table('article')->where('author_id','=',$id)->where('article_type','=','recruit')->update(['recruit_people'=>'']);
        //公司信息未读数减$cont
        $count = DB::table('company')->where('id','=',$id)->value('message_count');
        $message_count = $count - $cont;
        DB::table('company')->where('id','=',$id)->update(['message_count'=>$message_count]);
        //返回输出
        return $result ? '1' : '0';


    }



}
