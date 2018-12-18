<!doctype html>
<html lang="zh">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>主页 -@if($data['type'] == 'company') {{$res['0']->com_name}} @else {{$res['0']->username}} @endif</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="/home/statics/css/index.css" media="all" />
<link rel="stylesheet" href="/home/css/bootstrap.min.css">
<script src="/home/js/jquery.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script>
<style>
	.album-content{
		/*word-wrap: break-word;
		word-break: normal;*//*超出范围自动换行*/
		overflow:hidden; 
		text-overflow:ellipsis;
		display:-webkit-box; 
		-webkit-box-orient:vertical;
		-webkit-line-clamp:3; 
	}
	
</style>
</head>

<body class="home blog custom-background round-avatars">
<div class="Yarn_Background" style="background-image: url( /home/statics/images/47fb3c_.jpg );"></div>
<form class="js-search search-form search-form--modal" method="get" action="/home/search/index" role="search">
	<div class="search-form__inner">
		<div>
			<div id="search-container" class="ajax_search">
				<form method="get" id="searchform" action="">
					<div class="filter_container">
						<input type="text" value="" autocomplete="off" placeholder="请输入要查询的内容" name="search_text" id="search-input" />
						<ul id="search_filtered" class="search_filtered"></ul>
					</div>
					<input type="hidden" name="user_id" value="{{$res['0']->id}}">
					<input type="hidden" name="user_type" value="{{$data['type']}}">
					<input type="submit" id="searchsubmit" class="searchsubmit"/>
				</form>
			</div>
		</div>
	</div>
</form>
<div class="hebin" data-aos="fade-down">
	<i class=" js-toggle-search iconfont">&#xe60e;</i>
</div>

<header id="masthead" class="overlay animated from-bottom" itemprop="brand">
	<!-- 头像 -->
	<div class="site-branding text-center">
		@if(!isset($res['0']->com_name))
			<a href="/home/homepage/resume/{{$res['0']->id}}" target="_blank" title="查看简历">
				<figure>
					<img style="width: 90px;height: 90px;" class="custom-logo avatar" src="{{$res['0']->avatar}}" />
				</figure>
			</a>
		@else
			<figure>
				<img style="width: 90px;height: 90px;" class="custom-logo avatar" src="{{$res['0']->avatar}}"/>
			</figure>
		@endif
		<h3 class="blog-description"><p>
			@if($data['type'] == 'company')
				@if($res['0']->com_name)
					{{$res['0']->com_name}}
					@if($data['id'] == $data['login_id'])
						<a href="/home/edit/index/{{$data['type']}}/{{$res['0']->id}}" title="编辑基本信息"><span class="glyphicon glyphicon-pencil"></span></a>
					@endif
				@else
					企业名
					@if($data['id'] == $data['login_id'])
						<a href="/home/edit/index/{{$data['type']}}/{{$res['0']->id}}" title="编辑基本信息"><span class="glyphicon glyphicon-pencil"></span></a>
					@endif
				@endif
			@elseif($data['type'] == 'member')
				@if($res['0']->username)
					{{$res['0']->username}}
					@if($data['id'] == $data['login_id'])
						<a href="/home/edit/index/{{$data['type']}}/{{$res['0']->id}}" title="编辑基本信息"><span class="glyphicon glyphicon-pencil"></span></a>
					@endif
				@else
					用户名
					@if($data['id'] == $data['login_id'])
						<a href="/home/edit/index/{{$data['type']}}/{{$res['0']->id}}" title="编辑基本信息"><span class="glyphicon glyphicon-pencil"></span></a>
					@endif
				@endif
			@endif
		</p>
		</h3>
	</div>
	
	<div style="margin-top: 32px">
	<table style="height: 110px;font-size: 15px" border="0" cellpadding="0" cellspacing="0">
		@if($data['type'] == 'company')
			<tr align="center">
				<td width="341px">企业名：{{$res['0']->com_name}}</td>
				<td width="341px">邮箱：{{$res['0']->email}}</td>
				<td width="341px">联系电话：{{$res['0']->mobile}}</td>
				<td width="341px">员工数：{{$res['0']->emp_count}}</td>
			</tr>
			<tr align="center">
				<td colspan="4">地址：{{$data['country']}}-{{$data['province']}}-{{$data['city']}}-{{$data['county']}}</td>
			</tr>
		@elseif($data['type'] == 'member')
			<tr align="center">
				<td width="341px">用户名：{{$res['0']->username}}</td>
				<td width="341px">性别：
					@if($res['0']->gender == '1')
						男
					@elseif($res['0']->gender == '2')
						女
					@else
						保密
					@endif
				</td>
				<td width="341px">年龄：{{$res['0']->age}}</td>
				<td width="341px">邮箱：{{$res['0']->email}}</td>
			</tr>
			<tr align="center">
				<td>联系电话：{{$res['0']->mobile}}</td>
				<td>学历：
					@if($res['0']->education == '1')
						高中
					@elseif($res['0']->education == '2')
						大专
					@elseif($res['0']->education == '3')
						本科
					@elseif($res['0']->education == '4')
						硕士
					@elseif($res['0']->education == '5')
						博士
					@else
						其他
					@endif
				</td>
				<td>毕业院校：
					@if(isset($data['school']))
						<span class="glyphicon glyphicon-home"></span>&nbsp;<a style="color: white;text-decoration: none;" href="/home/homepage/index/company/{{$data['school_id']}}">{{$data['school']}}</a>&nbsp;
						@if($res['0']->school_validate == '1')
							<button type="button" disabled style="height: 20px;line-height:5px;width: 60px;padding-left: 5px" class="btn btn-default">未认证</button>
						@elseif($res['0']->school_validate == '2')
							<button type="button" disabled style="height: 20px;line-height:5px;width: 70px;padding-left: 5px" class="btn btn-warning">✔已认证</button>
						@endif
					@endif
				</td>
				<td>地址：{{$data['country']}}-{{$data['province']}}-{{$data['city']}}-{{$data['county']}}
				</td>
			</tr>
		@endif

	</table>
	</div>
	<!-- .site-branding -->
	<div class="decor-part">
		<div id="particles-js"></div>
	</div>

</header>
<div id="main" class="content">
	<div class="container">
		<article itemscope="itemscope">
			<div class="posts-list js-posts">

				<div class="post post-layout-list" data-aos="fade-up">
					<div class="status_list_item icon_kyubo">
						<div class="status_user" style="background-image: url(/home/statics/images/b0ce3f3cde0c084b6d42321b2dcbc407.jpeg);">
							<div class="status_section">
								<!-- <a href="" style="text-decoration: none" class="status_btn">公司简介</a> -->
								@if($data['type'] == 'company')
									<span class="status_btn">公司简介</span>
									<p class="section_p">{!!$res['0']->introduction!!}</p>
								@elseif($data['type'] == 'member')
									<span class="status_btn">个人简介</span>
									<p class="section_p">{!!$res['0']->introduction!!}</p>
								@endif
							</div>
						</div>
					</div>
				</div>
				<h1 style="margin-left: 170px;color: #0066CC">动态</h1>
				<hr style="height:1px;border:none;border-top:1px dashed #0066CC;" /><br>
				

				
				@foreach($data2 as $val)
				<div class="post post-layout-list js-gallery" data-aos="fade-up">
					<div class="post-album">
						<div class="row content">
							<div class="bg" style="background-image: url(/home/statics/images/IMG_0150.jpg);">
							</div>
							<div class="contentext flex-xs-middle">
								@if(!empty($val->recruit_title))
									<div class="review-item-title">
										<a href="/home/article/recruit/{{$val->id}}" rel="bookmark">{{$val->recruit_title}}</a>
									</div>
								@endif
								<div class="album-content">
									@if($val->article_type == 'recruit')
										<a style="text-decoration: none;color: white;" href="/home/article/recruit/{{$val->id}}">
											{!!$val->content!!}
										</a>
									@else
										<a style="text-decoration: none;color: white;" href="/home/article/index/{{$val->id}}">
											{!!$val->content!!}
										</a>
									@endif
								</div>
								<h5 class="review-item-creator"><b>发布日期：</b>{{$val->created_at}}
								</h5>
							</div>
							@if(!empty($val->img))
							<div class="album-thumb-width flex-xs-middle">
								<div class="row album-thumb no-gutter">
									<div class="col-xs-12">
										<img class="thumb" style="max-width: 285px;max-height: 165px;" src="{{$val->img}}"/>
									</div>
								</div>
							</div>
							@endif
						</div>
					</div>
				</div>
				@endforeach



			</div>
	</div>
</div>

<footer id="footer" class="overlay animated from-top">

	<div class="socialize" data-aos="zoom-in">
		<li>
			<a title="weibo" class="socialicon" href=""><i class="iconfont" aria-hidden="true">&#xe601;</i></a>
		</li>
		<li class="wechat">
			<a class="socialicon"><i class="iconfont">&#xe609;</i></a>
			<div class="wechatimg"><img src="/home/statics/images/49D3746D-7519-B709-83E4-65BD1927C4E7.jpg"></div>
		</li>
		<li>
			<a title="QQ" class="socialicon" href="" target="_blank"><i class="iconfont" aria-hidden="true">&#xe616;</i></a>
		</li>
	</div>
	<div class="cr">
		Copyright © 2010 - 2018 
		@if($data['type'] == 'company')
			{{$res['0']->com_name}}
		@else
			Workplace-social
		@endif
		. All Rights Reserved.
	</div>
</footer>
<script type='text/javascript' src='/home/statics/js/jquery.min.js'></script>
<script type='text/javascript' src='/home/statics/js/plugins.js'></script>
<script type='text/javascript' src='/home/statics/js/script.js'></script>
<script type='text/javascript' src='/home/statics/js/particles.js'></script>
<script type='text/javascript' src='/home/statics/js/aos.js'></script>

</body>

</html>