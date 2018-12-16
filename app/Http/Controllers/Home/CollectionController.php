<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class CollectionController extends Controller
{
    //收藏首页
    public function index(){
    	//查询数据
    	$user_id = Auth::guard('member')->user()->id;
    	//收藏的文章id集合
    	$collection_id = DB::table('member')->where('id','=',$user_id)->value('collection_id');
    	//将id结合拆分成数组
    	$collectionArr = explode(',', rtrim($collection_id,','));
    	//查询每篇文章的内容
    	$length = count($collectionArr);
    	// dd($collectionArr);
    	if($length > 0 && !empty($collectionArr['0'])){
    		for($i = 0; $i < $length; $i++){
	    		$data[$i] = DB::table('article')->where('id','=',$collectionArr[$i])->get();
	    		// dd($data);
	    		//查询该职位的工作省市
	    		$data[$i]['0']->province = DB::table('area')->where('id','=',$data[$i]['0']->province_id)->value('area');
	    		$data[$i]['0']->city = DB::table('area')->where('id','=',$data[$i]['0']->city_id)->value('area');
	    	}
    	}else{
    		$data = 'nothing';
    	}
    	
    	// dd($data);
    	//展示视图
    	return view('home.collection.index', compact('data'));
    }

    //添加收藏
    public function add(Request $request){
    	// dd($request->all());
    	//接收文章id
    	$article_id = $request->id;
    	//当前用户id
    	$user_id = Auth::guard('member')->user()->id;
    	//查询该用户收藏的文章id集合
    	$collect = DB::table('member')->where('id','=',$user_id)->value('collection_id');
    	$collection_id = $article_id.','.$collect;
    	//存入数据库
    	$result = DB::table('member')->where('id','=',$user_id)->update(['collection_id'=>$collection_id]);
    	//返回输出
    	return $result ? '1' : '0';
    }

    //取消收藏
    public function less(Request $request){
    	//接收文章id
    	$article_id = $request->id;
    	//当前用户id
    	$user_id = Auth::guard('member')->user()->id;
    	//查询该用户收藏的文章id集合
    	$collect = DB::table('member')->where('id','=',$user_id)->value('collection_id');
    	$collect2 = explode(',', rtrim($collect,','));
    	//进行匹对，将该文章id从集合中删除
    	for($i = 0; $i < count($collect2); $i++){
    		if($collect2[$i] == $article_id){
    			unset($collect2[$i]);
    		}
    	}
    	//将id集合数组组合回字符串，若为空数组，则设置为空，末尾不再有逗号
    	if(count($collect2) > 0){
    		$collection_id = implode(',', $collect2).',';
    	}else{
    		$collection_id = '';
    	}
    	//更新数据库
    	$result = DB::table('member')->where('id','=',$user_id)->update(['collection_id'=>$collection_id]);
    	//返回输出
    	return $result ? '1' : '0';
    }
}
