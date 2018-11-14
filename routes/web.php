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
	Route::post('uploader/webuploader', 'Admin\UploaderController@webuploader');//异步上传
	Route::get('member/getareabyid','Admin\MemberController@getAreaById');//ajax联动

});

