<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Input;
//引入Storage
use Storage;
use Session;
use Auth;
use DB;
//引入模型
use App\Home\Article;
use App\Home\Comment;

class ArticleController extends Controller
{
    //添加动态
    public function add(Request $request){
    	if(Input::method() == 'POST'){
    		//判断登录账号类型
			if(Session::get('loginType') == 'company'){
				$author_id = Auth::guard('company')->user()->id;
				$author_name = Auth::guard('company')->user()->com_name;
				$author_avatar = Auth::guard('company')->user()->avatar;
				$author_type = 'company';
			}elseif(Session::get('loginType') == 'member'){
				$author_id = Auth::guard('member')->user()->id;
				$author_name = Auth::guard('member')->user()->username;
				$author_avatar = Auth::guard('member')->user()->avatar;
				$author_type = 'member';
			}

    		//判断是否有文件上传成功
    		if($request->hasFile('picture') && $request->file('picture')->isValid()){
				//保存的文件名
				$filename = sha1(time() . $request -> file('picture') -> getClientOriginalName()) . '.' .  $request -> file('picture') -> getClientOriginalExtension();
				//文件保存/移动
				Storage::disk('public') -> put($filename, file_get_contents($request -> file('picture') -> path()));

				//数据入库article表
				//替换空格和换行
				$pattern = array('/ /','/　/','/\r\n/','/\n/');
				$replace = array('&nbsp;','&nbsp;','<br/>','<br/>');
				$content = preg_replace($pattern, $replace, $request->content);
				// $content = nl2br($request->content);//nl2br函数只替换了换行，空格没有解决
				//存储数据
				$result = Article::insert([
					'content'	=>	$content,
					'img'		=>	'/storage/' . $filename,
					'author_id'	=>	$author_id,
					'author_name'=>	$author_name,
					'author_avatar'	=>	$author_avatar,
					'author_type'	=>	$author_type,
					'created_at'=>	date('Y-m-d H:i:s')
				]);
				//返回输出
				return $result ? '1' : '0';
    		}else{
    			//数据入库article表
				//替换空格和换行
				$pattern = array('/ /','/　/','/\r\n/','/\n/');
				$replace = array('&nbsp;','&nbsp;','<br/>','<br/>');
				$content = preg_replace($pattern, $replace, $request->content);
				// $content = nl2br($request->content);//nl2br函数只替换了换行，空格没有解决
				//存储数据
				$result = Article::insert([
					'content'	=>	$content,
					'author_id'	=>	$author_id,
					'author_name'=>	$author_name,
					'author_avatar'	=>	$author_avatar,
					'created_at'=>	date('Y-m-d H:i:s')
				]);
				//返回输出
				return $result ? '1' : '0';
    		}
    	}
    }

    //动态详情
    public function index(Request $request){
    	//获取文章id
    	$id = $request->id;
    	//查询文章数据
    	$data = Article::where('id','=',$id)->get();
    	//查询评论数据
    	$data2 = Comment::where('article_id', '=', $id)->orderBy('created_at','desc')->get();
    	//点赞的人
    	if(Session::get('loginType') == 'company'){
    		$zan_people = 'company@'.Auth::guard('company')->user()->id;
    	}elseif(Session::get('loginType') == 'member'){
    		$zan_people = 'member@'.Auth::guard('member')->user()->id;
    	}
    	//展示视图
    	return view('home.article.index', compact('data', 'data2', 'zan_people'));
    }

    //点赞.取消赞
    public function dianzan(Request $request){
    	//判断是点赞还是取消赞
    	$type = $request->type;
    	//文章id
		$id = $request->id;

    	//获取文章原来赞数量和点赞人信息
		$data = Article::where('id','=',$id)->select('zan_count','zan_people')->get();
    	//获取点赞/取消赞人信息
    	if(Session::get('loginType') == 'company'){
			$people = 'company'.'@'.Auth::guard('company')->user()->id;
		}elseif(Session::get('loginType') == 'member'){
			$people = 'member'.'@'.Auth::guard('member')->user()->id;
		}
		//点赞
    	if($type == 'add'){
    		//点赞数加1
    		$zan_count = $data['0']->zan_count + 1;
    		//添加点赞人
    		$zan_people = $people.','.$data['0']->zan_people;
    		//更新数据库
    		$result = Article::where('id','=',$id)->update([
    			'zan_count'	=>	$zan_count,
    			'zan_people'=>	$zan_people
    		]);
    		//返回输出
			return $result ? '1' : '0';
    	}elseif($type == 'less'){
    		//取消赞
    		$zan_count = $data['0']->zan_count - 1;//点赞数减1
    		//去除点赞人
    		$zan_people = str_replace($people.',', '', $data['0']->zan_people);
    		//更新数据库
    		$result = Article::where('id','=',$id)->update([
    			'zan_count'	=>	$zan_count,
    			'zan_people'=>	$zan_people
    		]);
    		//返回输出
			return $result ? '1' : '0';
    	}

    }

    //评论
    public function addComment(Request $request){
    	//接收数据
    	//替换空格和换行
		$pattern = array('/ /','/　/','/\r\n/','/\n/');
		$replace = array('&nbsp;','&nbsp;','<br/>','<br/>');
		$content = preg_replace($pattern, $replace, $request->com_content);//评论内容
    	$article_id = $request->id;//文章id
    	//评论者信息
    	if(Session::get('loginType') == 'company'){
			$author_id = Auth::guard('company')->user()->id;//评论者id
			$author_name = Auth::guard('company')->user()->com_name;//评论者名称
			$author_avatar = Auth::guard('company')->user()->avatar;//评论者头像
			$author_type = 'company';//评论者类型
		}elseif(Session::get('loginType') == 'member'){
			$author_id = Auth::guard('member')->user()->id;
			$author_name = Auth::guard('member')->user()->username;
			$author_avatar = Auth::guard('member')->user()->avatar;
			$author_type = 'member';//评论者类型
		}
		//数据入库
		$result = Comment::create([
			'content'	=>	$content,
			'article_id'=>  $article_id,
			'author_id'	=>	$author_id,
			'author_name'=>	$author_name,
			'author_avatar'	=>	$author_avatar,
			'author_type'	=>	$author_type,
			'created_at'=>	date('Y-m-d H:i:s')
		]);
		//获取文章原来评论数量
		$com_count = Article::where('id','=',$article_id)->value('com_count');
		Article::where('id','=',$article_id)->update(['com_count' => $com_count+1]);
		//返回输出
		return $result ? '1' : '0';
    }

    //发布招聘信息
    public function addRecruit(Request $request){
    	if(Input::method() == 'POST'){
    		// dd($request->all());
    		//接收数据
    		//招聘职位
    		$recruit_title = $request->recruit_title;
    		//职能性质
    		$recruit_type = $request->recruit_type;
    		//职能类别
    		$category_id = $request->category_id;
    		//所需学历
    		$education = $request->education;
    		//所需工作经验
    		$work_experience = $request->work_experience;
    		//职能描述
    		//替换空格和换行
			$pattern = array('/ /','/　/','/\r\n/','/\n/');
			$replace = array('&nbsp;','&nbsp;','<br/>','<br/>');
			$content = preg_replace($pattern, $replace, $request->content);
    		//招聘人id
    		$author_id = Auth::guard('company')->user()->id;
    		//招聘人名称
    		$author_name = Auth::guard('company')->user()->com_name;
    		//招聘人头像
    		$author_avatar = Auth::guard('company')->user()->avatar;
    		//文章类型
    		$article_type = 'recruit';
    		//数据入库
    		$result = Article::insert([
    			'content'	=>	$content,
    			'author_id'	=>	$author_id,
    			'article_type'	=>	$article_type,
    			'author_name'	=>	$author_name,
    			'author_avatar'	=>	$author_avatar,
    			'author_type'	=>	'company',
    			'recruit_title'	=>	$recruit_title,
    			'recruit_type'	=>	$recruit_type,
    			'category_id'	=>	$category_id,
    			'education'		=>	$education,
    			'work_experience'	=>	$work_experience,
    			'created_at'	=>	date('Y-m-d H:i:s')
    		]);
    		//返回输出
    		return $result ? '1' : '0';
    	}
    	//查询数据
    	$category = DB::table('category')->get();
    	//展示视图
    	return view('home.article.addrecruit', compact('category'));
    }

    //招聘动态详情
    public function recruit(Request $request){
    	//接收文章id
    	$id = $request->id;
    	//查询数据
    	$data = DB::table('article')->where('id','=',$id)->get();
    	//发布者id
    	$author_id = $data['0']->author_id;
    	
    	$data2 = DB::table('company')->where('id', '=', $author_id)->get();
    	//发布者简介
    	$introduction = $data2['0']->introduction;
    	//发布者电话
    	$mobile = $data2['0']->mobile;

    	$country_id = $data2['0']->country_id;//国家id
		$province_id = $data2['0']->province_id;//省份id
		$city_id = $data2['0']->city_id;//城市id
		$county_id = $data2['0']->county_id;//县区id
		//前往区域area表中查询地址名
		$country = DB::table('area')->where('id','=',$country_id)->value('area');
		$province = DB::table('area')->where('id','=',$province_id)->value('area');
		$city = DB::table('area')->where('id','=',$city_id)->value('area');
		$county = DB::table('area')->where('id','=',$county_id)->value('area');

    	//职能类别
    	$category_id = $data['0']->category_id;
    	$category_name = DB::table('category')->where('id','=',$category_id)->value('category_name');

    	$data3 = [
    		'introduction'	=>	$introduction,
    		'category_name'	=>	$category_name,
    		'mobile'		=>	$mobile,
    		'country'	=>	$country,
			'province'	=>	$province,
			'city'		=>	$city,
			'county'	=>	$county
    	];
    	
    	//展示视图
    	return view('home.article.recruit', compact('data', 'data3'));
    }














}
