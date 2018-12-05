<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Document</title>
<link rel="stylesheet" href="/home/css/bootstrap.min.css">
<script src="/home/js/jquery.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<style type="text/css">
.post-album {
	max-width: 750px;
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
.content-info{
	height: 50px;
	margin-bottom: 10px;
}
.content-text{
	color: #404040;
	line-height: 25px;
	word-spacing:2px;/*词间距*/
	font-size: 16px;
	margin-top: 25px;
	margin-left: -10px;

	/*overflow:hidden; 
	text-overflow:ellipsis;
	display:-webkit-box; 
	-webkit-box-orient:vertical;
	-webkit-line-clamp:3; */
}
.img{
	margin: 15px 0px 15px;
	max-width: 490px;
}
#avatar{ 
	margin:10px auto;
} 
#avatar img{ 
	border-radius:50%;
}
.out{
	box-shadow:0px 0px  10px 1px #aaa;
}


.post-album2 {
	max-width: 750px;
	padding: 0 1.3rem 0;
	border-radius: 6px;
	overflow: hidden;
	margin: 10px auto 0;
	/*border: 1px solid #C2C2C2;*/
	box-shadow: 0 1px 3px rgba(249, 249, 249, 0.08), 0 0 0 1px rgba(26, 53, 71, .04), 0 1px 1px rgba(26, 53, 71, .06);
}
.content2{
	margin: 15px;
}
.content-info2{
	height: 30px;
}
.content-text2{
	color: #404040;
	line-height: 25px;
	word-spacing:2px;/*词间距*/
	font-size: 15px;
	margin-top: 25px;
	margin-left: -10px;
	word-wrap:break-word;/*内容超过div长度自动换行*/

	/*overflow:hidden; 
	text-overflow:ellipsis;
	display:-webkit-box; 
	-webkit-box-orient:vertical;
	-webkit-line-clamp:3; */
}
.img2{
	margin: 15px 0px 15px;
	max-width: 490px;
}
#avatar2{ 
	margin:10px auto;
} 
#avatar2 img{ 
	border-radius:50%;
}

.com_box{
	max-width: 750px;
	overflow: hidden;
}
#com_content{
	overflow:hidden; 
	text-overflow:ellipsis;
	display:-webkit-box; 
	-webkit-box-orient:vertical;
}

</style>
</head>
<body style="background-color: #CACACA">
	<div class="container" style="margin-bottom: 20px;">

		<div class="post-album">
			<div class="content">
				<div class="content-info row">
					<div id="avatar" class="col-lg-2" style="margin-right: -5px;">
						<img width="50px" style="height: 50px;" src="{{$data['0']->author_avatar}}">
					</div>
					<div class="col-lg-10" style="height: 20px;margin-left:-45px;padding-top: 5px;">
						<b style="font-size: 20px">{{$data['0']->author_name}}</b>
						<div class="row">
							<div class="col-lg-12" style="height: 20px;padding-top: 10px;">
								<font color="#676767">{{$data['0']->created_at}}</font>
							</div>
						</div>
					</div>
				</div>
				<div class="content-text">{!!$data['0']->content!!}</div>
			</div>
			@if(!empty($data['0']->img))
			<div style="background-color: #F3F6F8;width: 750px;margin-left: -15px;">
				<div class="img"><img height="450px" style="max-width: 750px;" src="{{$data['0']->img}}" />
				</div>
			</div>
			@endif
			<div style="height: 25px;margin-left: 15px;">
				<font color="#666666">赞 (<span class="{{$data['0']->id}}">{{$data['0']->zan_count}}</span>)&nbsp;▪&nbsp;评论 ({{$data['0']->com_count}})</font>
			</div>
			<div style="width: 720px;border: 1px solid #E6E9EC;"></div>
			<div style="height: 40px;">
				<a id="{{$data['0']->id}}" class="zan" style="text-decoration: none;cursor: pointer; color: #333333;">
					<span style="height: 30px;width: 30px;margin-left: 20px;padding-top: 10px;" class="<?php $zan_array=explode(',', $data['0']->zan_people);if(in_array($zan_people, $zan_array)){echo 'glyphicon glyphicon-heart';}else{echo 'glyphicon glyphicon-heart-empty';} ?>"></span>
				</a>&nbsp;&nbsp;
				<a id="pinglun" style="text-decoration: none;cursor: pointer;color: #333333;">
					<span style="height: 30px;width: 30px;margin-left: 10px;padding-top: 10px;margin-right: 15px;" class="glyphicon glyphicon-pencil"></span>
				</a>
			</div>

			<!-- 评论框 -->
			<div class="com_box" id="com_box">
				<div class="row" style="margin-bottom: 10px;">
					<div class="col-lg-12">
						@if(Session::get('loginType') == 'company')
							<div id="avatar2" class="col-lg-2">
								<img width="35px" style="height: 35px;" src="{{Auth::guard('company')->user()->avatar}}">
							</div>
						@elseif(Session::get('loginType') == 'member')
							<div id="avatar2" class="col-lg-2">
								<img width="35px" style="height: 35px;" src="{{Auth::guard('member')->user()->avatar}}">
							</div>
						@endif
						<div class="col-lg-10" style="margin-left:-60px;padding-top: 5px;">
							<textarea id="com_content" style="width: 570px;height: 80px;" wrap="physical" placeholder="你要说点啥..."></textarea>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="col-lg-11"></div>
						<div class="col-lg-1" style="margin-left:-60px;margin-top: 5px;">
							<button class="btn btn-primary" id="addComment" style="margin-left: -20px;">发布</button>
						</div>
					</div>
				</div>
			</div>
			
			
			<!-- 评论列表 -->
			@foreach($data2 as $value)
			<div style="background-color: #F3F6F8;margin: -10px -15px 20px;">
				<div class="post-album2">
					<div class="content2">
						<div class="content-info2 row">
							<div id="avatar2" class="col-lg-2" style="margin-right: -5px;">
								<a href="/home/homepage/index/{{$value->author_type}}/{{$value->author_id}}" target="_blank">
									<img width="35px" style="height: 35px;" src="{{$value->author_avatar}}">
								</a>
							</div>
							<div class="col-lg-10" style="height: 20px;margin-left:-65px;padding-top: 5px;">
								<a href="/home/homepage/index/{{$value->author_type}}/{{$value->author_id}}" target="_blank" style="text-decoration: none;color: #428BCA;">
									<b style="font-size: 14px">{{$value->author_name}}</b>
								</a>
								<div class="row ali">
									<div class="col-lg-12" style="height: 20px;padding-top: 5px;">
										<font color="#676767">{{$value->created_at}}</font>&nbsp;&nbsp;&nbsp;&nbsp;<a id="{{$value->id}}" class="reply" style="text-decoration: none;cursor: pointer;color: #333333;"><span class="glyphicon glyphicon-comment"></span></a>
									</div>
								</div>
							</div>
						</div>

						<div id="pinglun{{$value->id}}" class="row">
							<div class="col-lg-2" style="margin-right: -5px;">
							</div>
							<div class="content-text2 col-lg-10" style="font-size: 15px;margin-left:-65px;">{!!$value->content!!}
							</div>
							@if(count($data3[$value->id]) > 0)
								<div class="col-lg-12" style="font-size: 15px;text-align: right;">
									<button id="zhankai{{$value->id}}" class="btn btn-default zhankai" type="button">
									    评论数： <span class="badge">{{count($data3[$value->id])}}</span>
									</button>
								</div>
							@endif
							<div class="col-lg-2" style="margin-right: -5px;"></div>
							<div  class="content-text2 row col-lg-10 {{$value->id}} reply_box" style="font-size: 15px;margin-left:-65px;">
								<textarea id="rep_content{{$value->id}}" style="width: 570px;height: 80px;" wrap="physical" placeholder="回复  {{$value->author_name}}："></textarea>
								<div class="col-lg-11"></div>
								<div class="col-lg-1" style="margin-left:-60px;margin-top: 5px;">
									<button id="{{$value->id}}" class="addReply btn btn-primary" style="margin-left: 40px;" value="{{$value->id}}">发表</button>
								</div>
							</div>
						</div>
						
						<!-- 回复列表 -->
						<div id="reply_liebiao{{$value->id}}" class="row reply_liebiao" >
						@foreach($data3[$value->id] as $val)
							<div class="col-lg-2" style="margin-right: -5px;"></div>
							<div class="content-text2 col-lg-10 row" style="font-size: 15px;margin-left:-65px;">
								<div class="col-lg-12 row" style="margin-left: -30px;">
									<div class="col-lg-2">
										<a href="/home/homepage/index/{{$val->author_type}}/{{$val->author_id}}" target="_blank">
											<img width="35px" style="height: 35px;border-radius: 50%;" src="{{$val->author_avatar}}">
										</a>
									</div>
									<div class="col-lg-10 row" style="margin-left: -60px;font-size: 14px;">
										<div class="col-lg-12">
											<a href="/home/homepage/index/{{$val->author_type}}/{{$val->author_id}}" target="_blank" style="text-decoration: none;color: #428BCA;"><b>{{$val->author_name}}</b></a>&nbsp;回复&nbsp;<a href="/home/homepage/index/{{$value->author_type}}/{{$value->author_id}}" target="_blank" style="text-decoration: none;color: #428BCA;"><b>{{$value->author_name}}</b></a>&nbsp;：
										</div>
										<div class="col-lg-12">
											<font color="#676767">{{$val->created_at}}</font>
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="col-lg-2"></div>
									<div class="col-lg-10" style="margin-left: -75px;font-size: 14px;">{{$val->content}}</div>
								</div>
							</div>
						@endforeach
						</div>
				
					</div>
				</div>
			</div>
			@endforeach


		</div>

		<div style="margin-top: 20px;">
			<center>
				Copyright © 2010 - 2018 Workplace-social. All Rights Reserved.
			</center>
		</div>
	
	</div>
</body>
<script>
$(function(){

	//点赞.取消赞
	$('.zan').click(function(){
		var id = $(this).attr('id');
		var zan_count = Number($('.'+id).text());
		console.log($('#'+id).find('span').attr('class'));
		if($('#'+id).find('span').attr('class') == 'glyphicon glyphicon-heart-empty'){
			//点赞
			$.get('/home/article/dianzan',{'id':id,'type':'add'},function(data){
				if(data == '1'){
					$('#'+id).find('span').attr('class','glyphicon glyphicon-heart');
					$('.'+id).text(++zan_count);//点赞数加1
				}
			});
		}else{
			//取消点赞
			$.get('/home/article/dianzan',{'id':id,'type':'less'},function(data){
				$('#'+id).find('span').attr('class','glyphicon glyphicon-heart-empty');
				$('.'+id).text(--zan_count);//点赞数减1
			});	
		}
	});

	//评论框
	$('.com_box').hide();
	$('#pinglun').click(function(){
		$('.reply_box').hide('200');
		$('.com_box').show(300);
	});

	//回复框
	$('.reply').hide();
	$('.reply_box').hide();
	$('.reply').click(function(){
		$('.reply_box').hide('200');
		var id = $(this).attr('id');
		$('.'+id).show('200');
	});

	

	//发表评论
	$('#addComment').click(function(){
		var com_content = $('#com_content').val();//评论内容
		var id = {{$data['0']->id}};//文章id
		$.post('/home/article/addComment',{'id':id, 'com_content':com_content ,'_token':'{{csrf_token()}}'},function(data){
			if(data){
				$('#com_box').after('<div style="background-color: #F3F6F8;margin: -10px -15px 20px;"><div class="post-album2"><div class="content2"><div class="content-info2 row"><div id="avatar2" class="col-lg-2" style="margin-right: -5px;"><a href="/home/homepage/index/'+data.author_type+'/'+data.author_id+'" target="_blank"><img width="35px" style="height: 35px;" src="'+data.author_avatar+'"></a></div><div class="col-lg-10" style="height: 20px;margin-left:-65px;padding-top: 5px;"><a href="/home/homepage/index/'+data.author_type+'/'+data.author_id+'" target="_blank" style="text-decoration: none;color: #428BCA;"><b style="font-size: 14px">'+data.author_name+'</b></a><div class="row"><div class="col-lg-12" style="height: 20px;padding-top: 5px;"><font color="#676767">'+data.created_at+'</font></div></div></div></div><div class="row"><div class="col-lg-2" style="margin-right: -5px;"></div><div class="content-text2 col-lg-10" style="font-size: 15px;margin-left:-65px;">'+data.content+'</div></div></div></div></div>');
				$('#com_content').val('');
				// alert("评论成功");
				// parent.window.location = parent.window.location;
			}else{
				alert("评论失败");
			}
		});
	});


	//鼠标经过显示回复按钮，移出去除按钮
	$('.ali').hover(
		function(e){
			var id = $(this).find('a').attr('id');
			$('#'+id).show();
		},
		function(){
			var id = $(this).find('a').attr('id');
			$('#'+id).hide();
		}
	);



	//回复列表(默认隐藏)
	$('.reply_liebiao').hide();

	//回复列表的展开与收缩
	$('.zhankai').click(function(){
		var zhankai = $(this).attr('id');
		var str = zhankai.substring(7);
		$('#reply_liebiao'+str).toggle();
	});



	//发表回复
	$('.addReply').click(function(){
		var pid = $(this).attr('id');//回复的评论的id
		var rep_content = $('#rep_content'+pid).val();//回复的内容
		var id = {{$data['0']->id}};//文章id
		$.post('/home/article/addReply',{'id':id, 'pid':pid, 'rep_content':rep_content, '_token':'{{csrf_token()}}'},function(data){
			if(data){
				$('.reply_box').hide();
				$('#pinglun'+pid).after('<div class="row"><div class="col-lg-2" style="margin-right: -5px;"></div><div class="content-text2 col-lg-10 row" style="font-size: 15px;margin-left:-65px;"><div class="col-lg-12 row" style="margin-left: -30px;"><div class="col-lg-2"><a href="/home/homepage/index/'+data.author_type+'/'+data.author_id+'" target="_blank"><img width="35px" style="height: 35px;border-radius: 50%;" src="'+data.author_avatar+'"></a></div><div class="col-lg-10 row" style="margin-left: -60px;font-size: 14px;"><div class="col-lg-12"><a href="/home/homepage/index/'+data.author_type+'/'+data.author_id+'" target="_blank" style="text-decoration: none;color: #428BCA;"><b>'+data.author_name+'</b></a>&nbsp;回复&nbsp;<a href="/home/homepage/index/'+data.parent_type+'/'+data.parent_id+'" target="_blank" style="text-decoration: none;color: #428BCA;"><b>'+data.parent_name+'</b></a>&nbsp;：</div><div class="col-lg-12"><font color="#676767">'+data.created_at+'</font></div></div></div><div class="col-lg-12"><div class="col-lg-2"></div><div class="col-lg-10" style="margin-left: -75px;font-size: 14px;">'+data.content+'</div></div></div></div>');
				//清除回复框中的内容
				$('#rep_content'+pid).val('');
			}else{
				layer.alert('回复失败');
			}
		});
	});


});	
</script>
</html>