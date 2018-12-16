<!doctype html>
<html lang="zh">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>"{{$search_text}}"|搜索</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" type="text/css" href="/home/statics/css/index.css" media="all" />
<style type="text/css">
	.content-text{
		/*最多显示两行，超过的用...表示*/
		max-width: 560px;
		max-height: 70px;
		overflow:hidden;
		text-overflow:ellipsis;
		display:-webkit-box; 
		-webkit-box-orient:vertical;
		-webkit-line-clamp:2; 
	}
</style>
</head>

<body class="home blog custom-background round-avatars">

	<div id="main" class="content">

		<div class="container">

			<h1 class="page-title">以&ldquo;{{$search_text}}&rdquo;为关键字</h1>
			<p class="Searchmeta">共计 {{$tot}} 篇文章</p>
			<div class="location">当前位置：
				<a href="/home/homepage/index/{{$user_type}}/{{$user_id}}">首页</a> &raquo; 搜索结果 &raquo; {{$search_text}}
			</div>
			@if(count($data) > 0)
				@foreach($data as $val)
					<div class="posts-list js-posts">
						<div class="archive-post">
							<div class="type">
								<div class="mask"><i class="iconfont">&#xe603;</i></div>
							</div>
							<h2 class="archive-title" style="color: #">
								<span class="content-text"><a href="/home/article/index/{{$val->id}}">{!!$val->content!!}</a></span>
								<div class="post-time">{{$val->created_at}}</div>
							</h2>
							<div class="post-category">
								<a href="" rel="category tag">Article</a>
							</div>
						</div>
					</div>
				@endforeach
			@else
				<center><h4>暂无相关动态</h4></center>
			@endif

			
			@if(count($data2) > 0)
				<div class="location">当前位置：
					<a href="/home/homepage/index/{{$user_type}}/{{$user_id}}">首页</a> &raquo; 招聘信息 &raquo; {{$search_text}}
				</div>
				@foreach($data2 as $val)
					<div class="posts-list js-posts">
						<div class="archive-post">
							<div class="type">
								<div class="mask"><i class="iconfont">&#xe603;</i></div>
							</div>
							<h2 class="archive-title" style="color: #">
								<span><a href="/home/article/recruit/{{$val->id}}">{{$val->recruit_title}}</a></span>	
								<div class="post-time">{{$val->created_at}}</div>
							</h2>
							<div class="post-category">
								<a href="" rel="category tag">Recruit</a>
							</div>
						</div>
					</div>
				@endforeach
			@endif





			<div class="mt+">
				<div class="pagination js-pagination">
					<div class="js-next pagination__load"></div>
				</div>
			</div>

		</div>
		
	</div>

	<script type='text/javascript' src='/home/statics/js/jquery.min.js'></script>
	<script type='text/javascript' src='/home/statics/js/plugins.js'></script>
	<script type='text/javascript' src='/home/statics/js/script.js'></script>
	<script type='text/javascript' src='/home/statics/js/particles.js'></script>
	<script type='text/javascript' src='/home/statics/js/aos.js'></script>

</body>

</html>