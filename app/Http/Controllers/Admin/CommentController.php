<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CommentController extends Controller
{
    //评论列表
    public function index(){
    	//查询数据
    	$data = DB::table('comment')->orderBy('article_id','asc')->get()->toArray();
    	//评论总数量
    	$tot = count($data);
    	//查询更多数据
    	for($i = 0; $i < $tot; $i++){
    		//查询文章作者信息
    		$article_data = DB::table('article')->where('id','=',$data[$i]->article_id)->get();
    		//文章作者
    		$data[$i]->article_author = $article_data['0']->author_name;
    		//文章内容
    		$data[$i]->article = $article_data['0']->content;
    		//被评人信息
    		$data[$i]->bei_author = DB::table('comment')->where('id','=',$data[$i]->pid)->value('author_name');
    		//被评内容
    		$data[$i]->bei_content = DB::table('comment')->where('id','=',$data[$i]->pid)->value('content');
    	}
    	//展示视图
    	return view('admin.comment.index', compact('data','tot'));
    }

    public function del(Request $request){
    	//评论id
    	$id = $request->id;
    	//从数据库中删除
    	$result = DB::table('comment')->where('id','=',$id)->delete();
    	//返回输出
    	return $result ? '1' : '0';
    }


}
