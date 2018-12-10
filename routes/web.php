<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//*****************************后台路由****************************************
//后台路由部分（不需要权限判断）
Route::group(['prefix'=>'admin'],function(){
	//后台登录路由
	Route::get('public/login', 'Admin\PublicController@login')->name('login');	
	//后台登录处理页面
	Route::post('public/check', 'Admin\PublicController@check');
	//退出登录
	Route::get('public/logout', 'Admin\PublicController@logout');
	Route::post('uploader/webuploader', 'Admin\UploaderController@webuploader');//异步上传	
});

//后台路由部分（需要权限判断）
Route::group(['prefix' => 'admin','middleware'=>'auth:admin'],function(){
	//后台首页路由
	Route::get('index/index', 'Admin\IndexController@index');
	Route::get('index/welcome', 'Admin\IndexController@welcome');

	//管理员管理模块
	Route::get('manager/index', 'Admin\ManagerController@index');//管理员列表
	Route::get('manager/stop', 'Admin\ManagerController@stop');//停用管理员
	Route::get('manager/start', 'Admin\ManagerController@start');//启用管理员
	Route::get('manager/del', 'Admin\ManagerController@del');//删除管理员

	//会员管理模块
	Route::get('member/index', 'Admin\MemberController@index');//会员列表
	Route::any('member/add', 'Admin\MemberController@add');//添加会员
	
	Route::get('member/getareabyid','Admin\MemberController@getAreaById');//ajax联动

	//企业管理模块
	Route::get('company/index', 'Admin\CompanyController@index');//企业列表
	Route::get('company/del', 'Admin\CompanyController@del');//删除企业

});




//*****************************前台路由****************************************
//前台路由部分
//首页
Route::get('/', 'Home\IndexController@index')->middleware('LoginCheck');

//不需要权限部分
Route::group(['prefix' => 'home'], function(){
	//登录页面
	Route::get('login/index', 'Home\LoginController@index');
	//登录处理页面
	Route::post('login/loginCheck', 'Home\LoginController@loginCheck');
	//退出登录
	Route::get('login/logout', 'Home\LoginController@logout');
	
	//注册页面
	Route::get('register/index', 'Home\RegisterController@index');
	//注册处理页面
	Route::post('register/regCheck', 'Home\RegisterController@regCheck');
});
//需要权限部分
Route::group(['prefix'=>'home','middleware'=>['LoginCheck']],function(){
	//个人主页
	Route::get('homepage/index/{type}/{id}', 'Home\HomepageController@index');
	//个人履历
	Route::get('homepage/resume/{id}', 'Home\HomepageController@resume');
	//添加工作经验
	Route::post('homepage/addResume', 'Home\HomepageController@addResume');

	//个人主页动态搜索
	Route::get('search/index', 'Home\SearchController@index');
	//主页编辑信息页面
	Route::any('edit/index/{type}/{id}', 'Home\EditController@index');
	Route::get('edit/getareabyid', 'Home\EditController@getAreaById');

	//动态管理部分
	//添加动态
	Route::any('article/add', 'Home\ArticleController@add');
	//动态详情
	Route::get('article/index/{id}', 'Home\ArticleController@index');
	//点赞
	Route::get('article/dianzan', 'Home\ArticleController@dianzan');
	//评论
	Route::post('article/addComment', 'Home\ArticleController@addComment');
	//回复
	Route::post('article/addReply', 'Home\ArticleController@addReply');
	//发布招聘信息
	Route::any('article/addRecruit', 'Home\ArticleController@addRecruit');
	//招聘信息详情
	Route::get('article/recruit/{id}', 'Home\ArticleController@recruit');

	//个人信息
	Route::get('message/index/{type}/{id}', 'Home\MessageController@index');
	//学校认证
	Route::get('message/renzheng', 'Home\MessageController@renzheng');
	//一键已读点赞和评论消息
	Route::get('message/chakan', 'Home\MessageController@chakan');

	//个人设置
	Route::get('setting/index', 'Home\SettingController@index');
	//求职偏好设置
	Route::post('setting/expect', 'Home\SettingController@expect');
	//打开/关闭是否被推荐
	Route::get('setting/tuijian', 'Home\SettingController@tuijian');

	//职位推荐
	Route::get('recommend/index', 'Home\RecommendController@index');

});
