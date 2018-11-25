<!doctype html>
<html lang="zh">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>主页</title>
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
								<input type="text" value="" autocomplete="off" placeholder="Type then select or enter" name="s" id="search-input" />
								<ul id="search_filtered" class="search_filtered"></ul>
							</div>
							<input type="submit" name="submit" id="searchsubmit" class="searchsubmit" value="" />
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
				<a href="">
					<figure>
						<img style="width: 90px;height: 90px;" class="custom-logo avatar" src="
						@if($data['type'] == 'company')
							{{$res['0']->avatar}}
						@elseif($data['type'] == 'member')
							{{$res['0']->avatar}}
						@endif
							" />
					</figure>
				</a>
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
						<td width="341px">邮箱：{{$res['0']->email}}</td>
						<td width="341px">联系电话：{{$res['0']->mobile}}</td>
					</tr>
					<tr align="center">
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
						<td>毕业院校：<span class="glyphicon glyphicon-home"></span>&nbsp;<a style="color: white;text-decoration: none;" href="/home/homepage/index/company/{{$data['school_id']}}">{{$data['school']}}</a>&nbsp;
							<button type="button" disabled style="height: 20px;line-height:5px;width: 70px;padding-left: 5px" class="btn btn-warning">✔已认证</button>
						</td>
						<td>工作经历：
							@if($data['company_name'])
							<span class="glyphicon glyphicon-briefcase"></span>
								<a style="color: white;text-decoration: none;" href="/home/homepage/index/company/{{$data['com_id']}}">{{$data['company_name']}}</a>
							@else
								无
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

						
						
						<div class="post post-layout-list" data-aos="fade-up">
							<div class="postnormal review ">
								<div class="post-container review-item">
									<div class="row review-item-wrapper">
										<div class="col-sm-3">
											<a rel="nofollow" href="detail.html">
												<div class="review-item-img" style="background-image: url(/home/statics/images/diego-ph-249471-2-800x1000.jpg);">
													
												</div>
											</a>
										</div>
										<div class="col-sm-9 flex-xs-middle">
											<div class="review-item-title">
												<a href="detail.html" rel="bookmark">我才不会写年终总结之瞎说篇</a>
											</div>
											<div class="review-item-creator"><b>发布日期：</b>2017-12-30</div>
											<span class="review-item-info"><b>总浏览量：</b>1203 reads</span>
										</div>
									</div>
									<div class="review-bg-wrapper">
										<div class="bg-blur" style="background-image: url(/home/statics/images/diego-ph-249471-2-800x1000.jpg);">
											
										</div>
									</div>
								</div>
								<div class="post-container">
									<div class="entry-content">确实讨厌去写所谓的年终总结，在公司已经被动的想领导上交一个总结，自己就懒得去总结，不然，我觉得脑子里应该会编写出八九不离十的内容，所以正经八儿的事情略了，瞎说一下。 年初的人事调动是个人最不能接受的事情，但不接受也得接受，老板一句“这是命令...</div>
									<div class="post-footer">
										<a class="gaz-btn primary" href="">READ MORE</a>
										<span class="total-comments-on-post pull-right"><a href="">31 Comments</a></span>
									</div>
								</div>
							</div>
						</div>
						

						
						@foreach($data2 as $val)
						<div class="post post-layout-list js-gallery" data-aos="fade-up">
							<div class="post-album">
								<div class="row content">
									<div class="bg" style="background-image: url(/home/statics/images/IMG_0150.jpg);">
									</div>
									<div class="contentext flex-xs-middle">
										<div class="album-content">
											<a style="text-decoration: none;color: white;" href="/home/article/index/{{$val->id}}">{!!$val->content!!}</a>
										</div>
										<h5 class="review-item-creator"><b>发布日期：</b>{{$val->created_at}}
										</h5>
									</div>
									<div class="album-thumb-width flex-xs-middle">
										<div class="row album-thumb no-gutter">
											<div class="col-xs-12"><img class="thumb" style="max-width: 285px;max-height: 165px;" src="{{$val->img}}"/></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endforeach



					</div>
					<!-- post-formats end Infinite Scroll star -->
					<!-- post-formats -->
					<!-- <div class="pagination js-pagination">
						<div class="js-next pagination__load">
							<a href=""><i class="iconfont">&#xe605;</i></a>
						</div>
					</div> -->
					<!-- -pagination  -->
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