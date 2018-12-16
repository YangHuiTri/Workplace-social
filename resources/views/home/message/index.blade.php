<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Message</title>
	<link rel="stylesheet" href="/home/css/bootstrap.min.css">
	<script src="/home/js/jquery.min.js"></script>
	<script src="/home/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
	<style type="text/css">
		.comment{
			width: 1000px;
			overflow: hidden;
			white-space:nowrap;
			text-overflow:ellipsis;
			-webkit-text-overflow:ellipsis;
		}
		.com{
			margin-top: 10px;
			width: 700px;
			overflow: hidden;
			white-space:nowrap;
			text-overflow:ellipsis;
			display:-webkit-box; 
			-webkit-box-orient:vertical;
			-webkit-line-clamp:3; 
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="page-header">
			<h1>Message <small>消息列表</small></h1>
		</div>
		
		@if($type == 'company' && !empty($data['0']['0']))
			<font style="font-size: 25px;color: #428BCA;margin-bottom: 20px;">认证消息</font>
			@foreach($data as $val)
				<div class="alert alert-success renzheng" role="alert">
					<strong>• New Message</strong>&nbsp;&nbsp;&nbsp;&nbsp;
				    <a href="/home/homepage/index/member/{{$val['0']->id}}" class="alert-link">{{$val['0']->username}}</a>
				    请求学校给出官方认证&nbsp;&nbsp;&nbsp;&nbsp;
				    {{$val['0']->created_at}}
				    <button id="{{$val['0']->id}}" style="float: right;margin-top: -5px;" class="btn btn-primary validate">认证</button>
				</div>
			@endforeach
			<div style="width: 1140px; border:1px solid gray;margin: 40px 0;"></div>
		@endif

		
		@if($type == 'company' && !empty($arr6['0']['0']))
		<div id="message2">
			<font style="font-size: 25px;color: #428BCA;margin-bottom: 20px;">申请信息</font><button id="qingchu" class="btn btn-primary" style="float: right;">全部清除</button><br>
			@foreach($arr6 as $val)
			<div class="alert alert-info" role="alert">
				<strong>• New Message</strong>&nbsp;&nbsp;&nbsp;&nbsp;
			    <a href="/home/homepage/index/member/{{$val['0']}}" class="alert-link">{{$val['2']}}</a>&nbsp;&nbsp;申请&nbsp;&nbsp;<a href="/home/article/recruit/{{$val['4']}}" class="alert-link">{{$val['3']}}</a>&nbsp;&nbsp;一职&nbsp;&nbsp;&nbsp;&nbsp;
			    {{$val['1']}}
			    <a href="/home/homepage/resume/{{$val['0']}}" style="float: right;margin-right: 10px;color: #245269;">查看履历</a>
			</div>
			@endforeach
			<div style="width: 1140px; border:1px solid gray;margin: 40px 0;"></div>
		</div>
		@endif
		
	
		<font style="font-size: 25px;color: #428BCA;">动态消息</font><button id="chakan" class="btn btn-primary" style="float: right;">一键已读</button><br>
		<div id="message">
			<!-- 点赞信息 -->
			@if(!empty($arr2['0']['1']))
				@foreach($arr2 as $value)
					<div class="alert alert-info alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>• New Message</strong>&nbsp;&nbsp;&nbsp;&nbsp;
					    <a href="/home/homepage/index/{{$value['0']}}/{{$value['1']}}" class="alert-link">{{$value['5']}}</a>
					    赞了你的动态&nbsp;&nbsp;&nbsp;&nbsp;
					    <div class="com">
					    	<a href="/home/article/index/{{$value['3']}}" style="text-decoration: none; color: #38393D">{!!$value['4']!!}</a>&nbsp;&nbsp;&nbsp;&nbsp;
					    </div>
					    {{$value['2']}}
					    <a href="/home/article/index/{{$value['3']}}" target="_blank" class="alert-link chakan" style="float: right;margin-top: -40px;">查看详情</a>
					</div>
				@endforeach
			@endif

			<!-- 评论信息 -->
			@if(!empty($arr4['0']['1']))
				@foreach($arr4 as $val)
					<div class="alert alert-info alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>• New Message</strong>&nbsp;&nbsp;&nbsp;&nbsp;
					    <a href="/home/homepage/index/{{$val['0']}}/{{$val['1']}}" class="alert-link">{{$val['2']}}</a>
					    评论了你的动态&nbsp;&nbsp;
					    <div class="com">
					    	<a href="/home/article/index/{{$val['3']}}" style="color:#38393D;text-decoration:none;">{!!$val['4']!!}</a>&nbsp;&nbsp;：
					    </div>
					    <div class="com" style="margin-top: 10px;color: #181915;"><strong>{!!$val['5']!!}</strong></div>&nbsp;&nbsp;&nbsp;&nbsp;
					    <div>{{$val['6']}}</div>
					    <div>
					    	<a href="/home/article/index/{{$val['3']}}" class="alert-link" style="float: right;margin-top: -50px;">查看详情</a>
					    </div>
					</div>
				@endforeach
			@endif
		</div>




	</div>
</body>
<script>
$(function(){
	var recruit_cont = {{$recruit_cont}};
	//清除点赞和评论信息
	$('#chakan').click(function(){
		$.get('/home/message/chakan',{'cont':recruit_cont},function(data){
			if(data == '1'){
				$('#message').hide(400);
			}else{
				layer.alert('这没有消息你点啥！！！');
			}
		});
		
	});

	//清除申请信息
	$('#qingchu').click(function(){
		$.get('/home/message/qingchu',{'cont':recruit_cont},function(data){
			if(data == '1'){
				$('#message2').hide(400);
			}else{
				layer.alert('这没有消息你点啥！！！');
			}
		});
		
	});

	//认证
	$('.validate').click(function(){
		var user_id = $(this).attr('id');
		var com_id = {{$id}};
		$.get('/home/message/renzheng',{'user_id':user_id,'com_id':com_id},function(data){
			if(data == '1'){
				$('#'+user_id).attr('class','btn btn-success validate');
				$('#'+user_id).text('已认证');
				layer.alert('认证成功');
				setTimeout(function(){
					$('#'+user_id).parent('.renzheng').remove();
				},1000);
			}else{
				layer.alert('认证失败，请稍后重试！');
			}
		});

		

		
		
		
	});
});
</script>
</html>