<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="/home/css/bootstrap.min.css">
<script src="/home/js/jquery.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<title>Workplace-social</title>
<style type="text/css">
	.post {
		position: relative;
		margin-left: -90px;
	}
	.post-album {
		max-width: 550px;
		padding: 0 1.3rem 0;
		border-radius: 6px;
		overflow: hidden;
		margin: 10px auto 0;
		border: 1px solid #C2C2C2;
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
		font-size: 15px;
		margin-top: 25px;
		margin-left: -10px;
		/*最多显示三行，超过的用...表示*/
		overflow:hidden;
		text-overflow:ellipsis;
		display:-webkit-box; 
		-webkit-box-orient:vertical;
		-webkit-line-clamp:4; 
	}
	.content-text2{
		color: #404040;
		line-height: 25px;
		word-spacing:2px;/*词间距*/
		font-size: 15px;
		margin-top: 25px;
		margin-left: -10px;
		/*最多显示三行，超过的用...表示*/
		overflow:hidden;
		text-overflow:ellipsis;
		display:-webkit-box; 
		-webkit-box-orient:vertical;
		-webkit-line-clamp:15; 
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

	#result{
        width: 200px;
        height:200px;
        /*border:1px solid #eee;*/
    }
    #result img{
        height: 200px;
    }

    .ui_button {
        display: inline-block;
        line-height: 45px;
        padding: 0 70px;
        color: #FFFFFF;
        font-family: "微软雅黑";
        font-weight: 700;
        cursor: pointer;
     }
     .ui_button_primary {
        background-color: #428BCA;
     }
     label.ui_button:hover {
        background-color: #2E6A9D;
     }
</style>
</head>
<body style="background-color: #F5F5F5;">
<!-- 导航条 -->
<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #283E4A;">
	<div class="container-fluid">
	    <div class="navbar-header">
		    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		    </button>
	      <a class="navbar-brand" href="/" style="color: white;">Workplace</a>
	    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    <ul class="nav navbar-nav">
		        <li class="active"><a href="#" class="glyphicon glyphicon-home">主页 <span class="sr-only">(current)</span></a></li>
		        @if(Session::get('loginType') == 'member')
		        	<li>
		        		<a href="/home/recommend/index" target="_blank" style="color: white;">职位推荐</a>
		        	</li>
		        	<li>
		        		<a href="/home/collection/index" target="_blank" style="color: white;">收藏</a>
		        	</li>
		        @else
		        	@for($i = 0; $i < 18; $i++)
		        		&nbsp;
	        		@endfor
		        @endif
		        <!-- <li class="dropdown">
		        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">Dropdown <span class="caret"></span></a>
		          	<ul class="dropdown-menu">
			            <li><a href="#">Action</a></li>
			            <li><a href="#">Another action</a></li>
			            <li><a href="#">Something else here</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="#">Separated link</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="#">One more separated link</a></li>
		          	</ul>
		        </li> -->
		    </ul>
		    <form class="navbar-form navbar-left" action="/home/index/search" method="post">
		        <div class="form-group">
	          		<input type="text" name="search_text" class="form-control" placeholder="Search">
		        </div>
		        {{csrf_field()}}
		        <button type="submit" class="btn btn-default">Submit</button>
		    </form>
		    <ul class="nav navbar-nav navbar-right">
		    	<li role="presentation">
	    			@if(Session::get('loginType')=='company')
		    			<a href="/home/message/index/company/{{Auth::guard('company')->user()->id}}" target="_blank"  style="color: white;">Messages <span class="badge">{{Auth::guard('company')->user()->message_count}}</span>
		    			</a>
		    		@elseif(Session::get('loginType') == 'member')
		    			<a href="/home/message/index/member/{{Auth::guard('member')->user()->id}}" target="_blank"  style="color: white;">Messages <span class="badge">{{Auth::guard('member')->user()->message_count}}</span>
		    			</a>
		    		@endif
		    	</li>
		      	<!-- @if(Session::get('loginType') != 'company' && Session::get('loginType') != 'member')
		        	<li><a href="/home/register/index">注册</a></li>
		        @endif -->
		        <li class="dropdown">
		        	@if(Session::get('loginType')=='company')
			        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">
			          		<span class="glyphicon glyphicon-home">
			          			@if(Auth::guard('company')->user()->com_name)
			          				{{Auth::guard('company')->user()->com_name}}
		          				@else
		          					{{Auth::guard('company')->user()->email}}
	          					@endif
			          			</span>
			          	<span class="caret"></span></a>
			          	<ul class="dropdown-menu">
				            <li>
				            	<a target="_blank" href="/home/homepage/index/{{Session::get('loginType')}}/{{Auth::guard('company')->user()->id}}"><span class="glyphicon glyphicon-home"> 主页</span></a>
				            </li>
			            	<li>
			            		<a href="/home/setting/index" target="_blank">
			            			<span class="glyphicon glyphicon-cog"> 设置</span>
			            		</a>
			            	</li>
				            <li role="separator" class="divider"></li>
				            <li>
				            	<a href="/home/login/logout">
				            		<span class="glyphicon glyphicon-off"> 退出登录</span>
				            	</a>
				            </li>
			          	</ul>

	          		@elseif(Session::get('loginType') == 'member')
		          		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: white;">
			          		<span class="glyphicon glyphicon-user">
			          			@if(Auth::guard('member')->user()->username)
			          				{{Auth::guard('member')->user()->username}}
		          				@else
		          					{{Auth::guard('member')->user()->email}}
	          					@endif
	          				</span>
			          	<span class="caret"></span></a>
			          	<ul class="dropdown-menu">
				            <li><a target="_blank" href="/home/homepage/index/{{Session::get('loginType')}}/{{Auth::guard('member')->user()->id}}"><span class="glyphicon glyphicon-home"> 主页</span></a></li>
				            <li>
				            	<a href="/home/article/record" target="_blank"><span class="glyphicon glyphicon-time"> 申请记录</span></a>
				            </li>
				            <li><a href="/home/setting/index" target="_blank"><span class="glyphicon glyphicon-cog"> 设置</span></a></li>
				            <li role="separator" class="divider"></li>
				            <li><a href="/home/login/logout"><span class="glyphicon glyphicon-off"> 退出登录</span></a></li>
			          	</ul>
          			@endif
		        </li>
		    </ul>
	    </div>
	</div>
</nav>
<!-- 导航条-结束 -->





<div class="container" style="padding-top: 70px;">

	<div style="border: 2px solid #A5A5A5;position: fixed; background-color: #FFFFFF; float: left;width: 220px;margin-top: 5px;">
		<div style="height: 170px;border-bottom: 1px solid #D9D9D9;">
			@if(Session::get('loginType') == 'company')
				<div style="height: 55px;background-color: #29313E;"></div>
				<img style="border-radius: 50%;margin-left: 75px;margin-top: -35px;margin-bottom: 15px; border:2px solid white;height: 70px;" width="70px" src="{{Auth::guard('company')->user()->avatar}}">
				<center><font size="3px" style="font-weight: bold;line-height: 30px;">{{Auth::guard('company')->user()->com_name}}</font></center>
				<center><font color="#666666">企业</font></center>
			@elseif(Session::get('loginType') == 'member')
				<div style="height: 55px;background-color: #29313E;"></div>
				<img style="border-radius: 50%;margin-left: 75px;margin-top: -35px;margin-bottom: 15px; border:2px solid white;height: 70px;" width="70px" src="{{Auth::guard('member')->user()->avatar}}">
				<center><font size="3px" style="font-weight: bold;line-height: 30px;">{{Auth::guard('member')->user()->username}}</font></center>
				@if(!empty(Auth::guard('member')->user()->company->com_name))
					<center><font color="#666666">{{Auth::guard('member')->user()->company->com_name}}</font></center>
				@else
					<center><font color="#666666">用户</font></center>
				@endif
			@endif
		</div>
		
		<div style="height: 70px;border-bottom: 1px solid #D9D9D9;padding-top: 5px;">
			<center><font color="#0073B1" size="5px">{{$tot}}</font></center>
			<center><font color="#666666">动态</font></center>
		</div>

		<div style="height: 70px;padding-top: 10px;background-color: #F5F5F5;">
			<center><font color="#666666" size="4px">9</font></center>
			<center><font color="#666666">获取独家工具</font></center>
		</div>
	</div>


	<div style="border: 1px solid #CFCFCF;position: fixed;left: 925px; background-color: #FFFFFF;float: right;width: 310px;margin-top: 5px;">
		<div style="height: 280px;border-bottom: 1px solid #D9D9D9;"><br><center><img src="/home/images/work.png"></center></div>
		<div style="height: 155px;border-bottom: 1px solid #D9D9D9;">
			<div style="margin: 20px;line-height: 30px;color: #4F6878">&nbsp;&nbsp;&nbsp;&nbsp;关于&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;帮助中心&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;隐私政策和条款﹀<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;广告发布&nbsp;&nbsp;&nbsp;&nbsp;商业服务﹀&nbsp;&nbsp;&nbsp;&nbsp;更多
			</div>
			<div style="padding: 0 20px;">
				<center>
					<font color="#666666"><img width="20px" src="/home/images/02.png">&nbsp;Workplace Corporation © 2018 年沪 ICP 备 17589602 号</font>
				</center>
				<center>
					<img src="/home/images/police.png"><font color="#666666">京公网安备 11070205060783 号</font>
				</center>
			</div>
		</div>
	</div>	
	


	<div class="post">

		<div class="out" style="border: 1px solid #CFCFCF;position: relative;max-width: 550px;margin: 5px auto 10px;">
			<a href="#" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">
				<div style="height: 70px;position: relative;max-width: 550px;margin: 0 auto 0;background-color: #FFFFFF;">
					<b><span class="glyphicon glyphicon-edit" style="color: #696C6F;margin: 25px;font-size: 17px;"><font size="4px" style="font-weight: bold;">发动态</font></span></b>
				</div>
			</a>
			<div style="height: 40px;position: relative;max-width: 550px;margin: 0 auto 0;background-color: #F3F6F8;padding: 10px 15px;">
				@if(Session::get('loginType') == 'company')
					<a href="/home/article/addRecruit" target="_blank">
						<span style="font-size: 15px;">发布招聘信息</span>
					</a>
				@elseif(Session::get('loginType') == 'member')
					<span style="color: #696C6F;font-size: 15px;">在这里发动态</span>
				@endif
			</div>
		</div>
		<!-- 发动态模态框-开始 -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content" style="width: 535px;">
			      	<div class="modal-header">
			       		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="exampleModalLabel">New message</h4>
			      	</div>
			      	<div class="modal-body">
			        	<form action="" method="post" id="dongtai">
				        	{{csrf_field()}}
					        <!-- <div class="form-group">
					            <label for="recipient-name" class="control-label">Recipient:</label>
					            <input type="text" class="form-control" id="recipient-name">
					        </div> -->
					        <div class="form-group">
					            <label for="message-text" class="control-label">内容:</label>
					            <textarea style="height: 200px;width: 500px;" name="content" class="form-control" id="content" wrap="physical"></textarea>
					        </div>

					        <div class="form-group">
					        	<label class="ui_button ui_button_primary" for="pic">选择图片</label>
	    						<input id="pic" type="file" name="picture" accept="image/*" onchange="selectFile()" style="position:absolute;clip:rect(0 0 0 0);"/>
	    						<!-- <div id="result"></div> -->
    						</div>
				        
						    <div class="modal-footer">
						        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
						        <button type="button" class="btn btn-primary" id="addArticle" style="width: 100px;height: 40px;">发&nbsp;&nbsp;&nbsp;送</button>
						    </div>
				      	</form>
		      		</div>
		    	</div>
		  	</div>
		</div>
		<!-- 模态框-结束 -->
		<div style="width: 550px;border: 1px solid #D0D0D0;margin-left: 340px;margin-top: 15px;margin-bottom: 15px;"></div>
		
		<!-- 动态 -->
<!-- 		<div class="post-album">
			<div class="content">
				<div class="content-info row">
					<div id="avatar" class="col-lg-2" style="margin-right: -5px;">
						<img width="50px" style="height: 50px;" src="/home/images/logo.png">
					</div>
					<div class="col-lg-10" style="height: 20px;margin-left:-15px;padding-top: 5px;">
						<b style="font-size: 20px">Username</b>
						<div class="row">
							<div class="col-lg-12" style="height: 20px;padding-top: 10px;">
								<font color="#676767">2018-11-22 10:20:35</font>
							</div>
						</div>
					</div>
				</div>
				<div class="content-text"><a style="text-decoration: none;color: #676767;" href="/home/article/index/33" target="_blank">相隔上一次的更新我掰手指数一数，下意识的双腿一软，给各位小哥哥小姐姐们跪下了。自从有了对象后，周末几乎落下了主题的进度（邪魅的笑）。一边开发新的主题，一边收集您们给我反馈回来的"臭虫"，还有新的主题后台看见了一些大神在</a></div>
			</div>
			<div style="background-color: #F3F6F8;width: 550px;margin-left: -15px;">
				<div class="img"><a href="/home/article/index/33" target="_blank"><img height="320px" style="max-width: 550px;" src="/home/images/bg.jpg" /></a>
				</div>
			</div>
			<div style="height: 25px;margin-left: 15px;" class="sanzi">
				<font color="#666666">赞 (<span id="zan_count">3435</span>)&nbsp;▪&nbsp;评论 (298)</font>
			</div>
			<div style="width: 520px;border: 1px solid #E6E9EC;"></div>
			<div style="height: 40px;">
				<a id="zan" style="text-decoration: none;color: #333333;">
					<span style="height: 30px;width: 30px;margin-left: 20px;padding-top: 10px;" class="glyphicon glyphicon-heart-empty"></span>
				</a>
				<span style="height: 30px;width: 30px;margin-left: 10px;padding-top: 10px;margin-right: 15px;" class="glyphicon glyphicon-pencil"></span>
			</div>
		</div> -->

		@foreach($data as $value)
		@if($value->article_type == 'recruit')
		<!-- 招聘动态 -->
			<div class="post-album" style="background-image: url('/home/images/recruit.png');background-repeat: no-repeat;">
				<div class="content">
					<div class="content-info row">
						<div id="avatar" class="col-lg-2" style="margin-right: -5px;">
							<a href="/home/homepage/index/{{$value->author_type}}/{{$value->author_id}}" target="_blank">
								<img width="50px" style="height: 50px;" src="{{$value->author_avatar}}">
							</a>
						</div>
						<div class="col-lg-10" style="height: 20px;margin-left:-15px;padding-top: 5px;">
							<b style="font-size: 20px">
								<a href="/home/homepage/index/{{$value->author_type}}/{{$value->author_id}}" style="text-decoration: none;color: #3671A2;" target="_blank">{{$value->author_name}}
								</a>
							</b>
							<div class="row">
								<div class="col-lg-12" style="height: 20px;padding-top: 10px;">
									<font color="#676767">{{$value->created_at}}</font>
								</div>
							</div>
						</div>
					</div>
					<div class="content-text2">
						<a style="text-decoration: none;color: #676767;" href="/home/article/recruit/{{$value->id}}" target="_blank">
							<b>{{$value->recruit_title}}</b><br>
							{!!$value->content!!}
						</a>
					</div>
				</div>
			</div>
		@else
		<!-- 普通动态 -->
			<div class="post-album">
				<div class="content">
					<div class="content-info row">
						<div id="avatar" class="col-lg-2" style="margin-right: -5px;">
							<a href="/home/homepage/index/{{$value->author_type}}/{{$value->author_id}}" target="_blank">
								<img width="50px" style="height: 50px;" src="{{$value->author_avatar}}">
							</a>
						</div>
						<div class="col-lg-10" style="height: 20px;margin-left:-15px;padding-top: 5px;">
							<b style="font-size: 20px">
								<a href="/home/homepage/index/{{$value->author_type}}/{{$value->author_id}}" style="text-decoration: none;color: #191919;" target="_blank">{{$value->author_name}}
								</a>
							</b>
							<div class="row">
								<div class="col-lg-12" style="height: 20px;padding-top: 10px;">
									<font color="#676767">{{$value->created_at}}</font>
								</div>
							</div>
						</div>
					</div>
					<div class="content-text">
						<a style="text-decoration: none;color: #676767;" href="/home/article/index/{{$value->id}}" target="_blank">
							{!!$value->content!!}
						</a>
					</div>
				</div>
				@if(!empty($value->img))
				<div style="background-color: #F3F6F8;width: 550px;margin-left: -15px;">
					<div class="img">
						<a href="/home/article/index/{{$value->id}}" target="_blank">
							<img height="320px" style="max-width: 550px;" src="{{$value->img}}" />
						</a>
					</div>
				</div>
				@endif
				<div style="height: 25px;margin-left: 15px;">
					<font color="#666666">赞 (<span class="{{$value->id}}">{{$value->zan_count}}</span>)&nbsp;▪&nbsp;评论 ({{$value->com_count}})</font>
				</div>
				<div style="width: 520px;border: 1px solid #E6E9EC;"></div>
				<div style="height: 40px;">
					<a id="{{$value->id}}" class="zan" style="text-decoration: none;cursor: pointer; color: #333333;">
						<span style="height: 30px;width: 30px;margin-left: 20px;padding-top: 10px;" class="<?php $zan_array=explode(',', $value->zan_people);if(in_array($zan_people, $zan_array)){echo 'glyphicon glyphicon-heart';}else{echo 'glyphicon glyphicon-heart-empty';} ?>"></span>
					</a>
					<a href="/home/article/index/{{$value->id}}" target="_blank" style="text-decoration: none;color: #333333;">
						<span style="height: 30px;width: 30px;margin-left: 10px;padding-top: 10px;margin-right: 15px;" class="glyphicon glyphicon-pencil"></span>
					</a>
				</div>
			</div>
		@endif
		@endforeach



	</div>



</div>

</body>
<script>
$(window).scroll(function(){
　　var scrollTop = $(this).scrollTop();
　　var scrollHeight = $(document).height();
　　var windowHeight = $(this).height();
　　if(scrollTop + windowHeight == scrollHeight){
　　　　alert("you are in the bottom");
　　}
});
//发动态时显示缩略图
var form = new FormData();//通过HTML表单创建FormData对象
var url = '127.0.0.1:8080/'
function selectFile(){
	//点击上传文件按钮时先清除显示缩略图的div，防止累加
	$('#result').remove();
	//用于在上传文件按钮下显示缩略图的div
	$("#pic").after('<div id="result"></div>');
    var files = document.getElementById('pic').files;
    console.log(files[0]);
    if(files.length == 0){
        return;
    }
    var file = files[0];
    //把上传的图片显示出来
    var reader = new FileReader();
    // 将文件以Data URL形式进行读入页面
    console.log(reader);
    reader.readAsBinaryString(file);
    reader.onload = function(f){
        var result = document.getElementById("result");
        var src = "data:" + file.type + ";base64," + window.btoa(this.result);
        result.innerHTML = '<img src ="'+src+'"/>';
    }
    console.log('file',file);
    form.append('file',file);
    console.log(form.get('file'));
}

function getMsgCount(){
	//发送ajax请求
    $.get("/home/message/getCount",function(data){
      //相应的处理代码
      $('.badge').html(data);
    });
}


$(function(){

	//定时器，实时获取未读消息数
	setInterval('getMsgCount()', 5000);

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

	// ajax发动态
	$('#addArticle').click(function(){
		//利用formdata将表单数据传输到指定路径
		var formData = new FormData(document.getElementById("dongtai"));
		$.ajax({
            type: "POST",
            url: "/home/article/add",  //同目录下的php文件
            data:formData,
            dataType:"json", //声明成功使用json数据类型回调
 
            //如果传递的是FormData数据类型，那么下来的三个参数是必须的，否则会报错
            cache:false,  //默认是true，但是一般不做缓存
            processData:false, //用于对data参数进行序列化处理，这里必须false；如果是true，就将FormData转换为String类型
            contentType:false,  //一些文件上传http协议的关系，自行百度，如果上传的有文件，那么只能设置为false
            success: function(data){  //请求成功后的回调函数
            	if(data){
            		alert('发送成功');
            		parent.window.location = parent.window.location;
            	}else{
            		alert('发送失败');
            	}
            }
        });
	});

});


</script>
</html>