<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/home/css/bootstrap.min.css">
	<script src="/home/js/jquery.min.js"></script>
	<script src="/home/js/bootstrap.min.js"></script>
 	<style type="text/css">
		.post-album {
			max-width: 790px;
			padding: 0 1.3rem 0;
			border-radius: 6px;
			overflow: hidden;
			margin: 20px auto 0;
			/*border: 1px solid #C2C2C2;*/
			background-color: #FFFFFF;
			box-shadow: 0 1px 3px rgba(249, 249, 249, 0.08), 0 0 0 1px rgba(26, 53, 71, .04), 0 1px 1px rgba(26, 53, 71, .06);
		}
		.content{
			margin: 15px;
		}
		.content-text{
			color: #666666;
			line-height: 30px;
			font-size: 16px;


			/*overflow:hidden; 
			text-overflow:ellipsis;
			display:-webkit-box; 
			-webkit-box-orient:vertical;
			-webkit-line-clamp:3; */
		}
	</style>
</head>
<body style="background-color: #CACACA">
	<div class="container" style="margin-bottom: 20px;">
		
		<div class="post-album" style="height: 190px;">
			<div class="content">
				<div class="row">
					<div class="col-lg-2" >
						<img width="120px" style="height: 120px;" src="{{$data['0']->author_avatar}}">
					</div>
					<div class="col-lg-10">
						<b style="font-size: 20px;margin-left: 20px;">{{$data['0']->recruit_title}}</b>
						<div class="row" style="margin-left: 5px;">
							<div class="col-lg-12" style="padding-top: 10px;">
								<font color="#676767" style="font-size: 20px;">{{$data['0']->author_name}}</font>
							</div>
							<div class="col-lg-12" style="padding-top: 10px;">
								<font color="#676767">发布日期：{{$data['0']->created_at}}</font>
							</div>
							<div class="col-lg-12" style="padding-top: 20px;">
								<button id="shenqing" class="btn btn-primary">立即申请</button>
							</div>
							
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="post-album">
			<div class="content">
				<div class="row" style="height: 60px;">
					<div class="col-lg-6 row">
						<span class="col-lg-12" style="font-size: 15px;font-weight: bold;height: 30px;">职位性质</span>
						<span class="col-lg-12">
							@if($data['0']->category_id == 1)
								全职
							@elseif($data['0']->category_id == 2)
								实习
							@else
								兼职
							@endif
						</span>
					</div>
					<div class="col-lg-6 row">
						<span class="col-lg-12" style="font-size: 15px;font-weight: bold;height: 30px;">职能类别</span>
						<span class="col-lg-12">{{$data3['category_name']}}</span>
					</div>
				</div>

				<div class="row" style="height: 60px;">
					<div class="col-lg-12" style="height: 30px;">
						<span style="font-size: 15px;font-weight: bold;">资历要求</span>
					</div>
					<div class="col-lg-12">
						<span class="col-lg-6">
							学历：
							@if($data['0']->education == 0)
								其他
							@elseif($data['0']->education == 1)
								高中
							@elseif($data['0']->education == 2)
								大专
							@elseif($data['0']->education == 3)
								本科
							@elseif($data['0']->education == 4)
								硕士
							@elseif($data['0']->education == 5)
								博士
							@else
								无
							@endif
						</span>
						<span class="col-lg-6">
							工作经验：
							@if($data['0']->work_experience == 0)
								无
							@else
								{{$data['0']->work_experience}} 年
							@endif
						</span>
					</div>
				</div>
				<br>
				<div style="width: 760px;border: 1px solid gray;margin-left: -20px;"></div>
				<font style="font-size: 20px;">职位描述</font>
				<div class="content-text">{!!$data['0']->content!!}</div>
				<br>
				<div style="width: 760px;border: 1px solid gray;margin-left: -20px;"></div>
				<font style="font-size: 20px;">联系我们</font>
				<div class="content-text">电话：{{$data3['mobile']}}</div>
				<div class="content-text">地址：{{$data3['country']}}-{{$data3['province']}}-{{$data3['city']}}-{{$data3['county']}}&nbsp;&nbsp;&nbsp;&nbsp;{{$data['0']->author_name}}</div>
				<br>
				<div style="width: 760px;border: 1px solid gray;margin-left: -20px;"></div>
				<font style="font-size: 20px;">公司简介</font>
				<div class="content-text">{!!$data3['introduction']!!}</div>
			</div>
		</div>

		<div style="margin-top: 20px;"><center>Copyright © 2010 - 2018 Workplace-social. All Rights Reserved.</center></div>

	
	</div>
</body>
<script>
$(function(){
	$('#shenqing').click(function(){
		$('#shenqing').attr('class','btn btn-success');
		$('#shenqing').text('已申请');
	});
});	
</script>
</html>