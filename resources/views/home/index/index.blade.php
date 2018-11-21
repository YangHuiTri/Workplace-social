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
			color: #676767;
			line-height: 25px;
			font-size: 15px;
			margin-top: 25px;
			margin-left: -10px;
		}
		.img{
			margin: 15px 30px 15px;
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
            border:1px solid #eee;
        }
        #result img{
            height: 200px;
        }
 	</style>
</head>
<body style="background-color: #F5F5F5;">
<!-- 导航条 -->
<nav class="navbar navbar-default" style="background-color: #283E4A;">
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
		        <li><a href="#">职位推荐</a></li>
		        <li class="dropdown">
		        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
		          	<ul class="dropdown-menu">
			            <li><a href="#">Action</a></li>
			            <li><a href="#">Another action</a></li>
			            <li><a href="#">Something else here</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="#">Separated link</a></li>
			            <li role="separator" class="divider"></li>
			            <li><a href="#">One more separated link</a></li>
		          	</ul>
		        </li>
		    </ul>
		    <form class="navbar-form navbar-left">
		        <div class="form-group">
	          		<input type="text" class="form-control" placeholder="Search">
		        </div>
		        <button type="submit" class="btn btn-default">Submit</button>
		    </form>
		    <ul class="nav navbar-nav navbar-right">
		      	@if(Session::get('loginType') != 'company' && Session::get('loginType') != 'member')
		        	<li><a href="/home/register/index">注册</a></li>
		        @endif
		        <li class="dropdown">
		        	@if(Session::get('loginType')=='company')
			        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			          		<span class="glyphicon glyphicon-home">
			          			@if(Auth::guard('company')->user()->com_name)
			          				{{Auth::guard('company')->user()->com_name}}
		          				@else
		          					{{Auth::guard('company')->user()->email}}
	          					@endif
			          			</span>
			          	<span class="caret"></span></a>
			          	<ul class="dropdown-menu">
				            <li><a target="_blank" href="/home/homepage/index/{{Session::get('loginType')}}/{{Auth::guard('company')->user()->id}}">主页</a></li>
				            <li><a href="#">Another action</a></li>
				            <li><a href="#">Something else here</a></li>
				            <li role="separator" class="divider"></li>
				            <li><a href="/home/login/logout">退出登录</a></li>
			          	</ul>

	          		@elseif(Session::get('loginType') == 'member')
		          		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			          		<span class="glyphicon glyphicon-user">
			          			@if(Auth::guard('member')->user()->username)
			          				{{Auth::guard('member')->user()->username}}
		          				@else
		          					{{Auth::guard('member')->user()->email}}
	          					@endif
	          				</span>
			          	<span class="caret"></span></a>
			          	<ul class="dropdown-menu">
				            <li><a target="_blank" href="/home/homepage/index/{{Session::get('loginType')}}/{{Auth::guard('member')->user()->id}}">主页</a></li>
				            <li><a href="#">Another action</a></li>
				            <li><a href="#">Something else here</a></li>
				            <li role="separator" class="divider"></li>
				            <li><a href="/home/login/logout">退出登录</a></li>
			          	</ul>
	          		@else
	          			<a href="/home/login/index" >登录</a>	
          			@endif
		        </li>
		    </ul>
	    </div>
	</div>
</nav>
<!-- 导航条-结束 -->





<div class="container">

	<div style="border: 2px solid #A5A5A5;background-color: #FFFFFF; float: left;width: 220px;margin-top: 5px;">
		<div style="height: 170px;border-bottom: 1px solid #D9D9D9;">
			<div style="height: 55px;background-color: #29313E;"></div>
			<img style="border-radius: 50%;margin-left: 75px;margin-top: -35px;margin-bottom: 15px; border:2px solid white;height: 70px;" width="70px" src="/home/images/01.png">
			<center><font size="3px" style="font-weight: bold;line-height: 30px;">阿里杨</font></center>
			<center><font color="#666666">学生-南昌大学</font></center>
		</div>
		
		<div style="height: 70px;border-bottom: 1px solid #D9D9D9;padding-top: 5px;">
			<center><font color="#0073B1" size="5px">9</font></center>
			<center><font color="#666666">动态</font></center>
		</div>

		<div style="height: 70px;padding-top: 10px;background-color: #F5F5F5;">
			<center><font color="#666666" size="4px">9</font></center>
			<center><font color="#666666">获取独家工具</font></center>
		</div>
	</div>


	<div style="border: 1px solid #CFCFCF;background-color: #FFFFFF;float: right;width: 310px;margin-top: 5px;">
		<div style="height: 280px;border-bottom: 1px solid #D9D9D9;"></div>
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
					<b><span class="glyphicon glyphicon-edit" style="color: #696C6F;margin: 25px;">发动态</span></b>
				</div>
			</a>
			<div style="height: 40px;position: relative;max-width: 550px;margin: 0 auto 0;background-color: #F3F6F8;padding: 10px 15px;">
				<span style="color: #696C6F;font-size: 15px;">在这里发动态</span>
			</div>
		</div>
		<!-- 发动态模态框-开始 -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
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
					            <textarea name="content" class="form-control" id="content"></textarea>
					        </div>

					        <div class="form-group">
	    						<input id="pic" type="file" name="picture" accept="image/*" onchange="selectFile()"/>
	    						<div id="result"></div>
    						</div>
				        
						    <div class="modal-footer">
						        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
						        <button type="button" class="btn btn-primary" id="addArticle">发送</button>
						    </div>
				      	</form>
		      		</div>
		    	</div>
		  	</div>
		</div>
		<!-- 模态框-结束 -->
		<div style="width: 550px;border: 1px solid #D0D0D0;margin-left: 340px;margin-top: 15px;margin-bottom: 15px;"></div>
		<!-- 动态 -->
		<div class="post-album">
			<div class="content">
				<div class="content-info row">
					<div id="avatar" class="col-lg-2" style="margin-right: -5px;margin-left: -10px;"><img width="50px" src="/home/images/logo.png">
					</div>
					<div class="col-lg-10" style="height: 20px;margin-left:-15px;padding-top: 5px;">
						<b style="font-size: 20px">username</b>
						<div class="row">
							<div class="col-lg-6" style="height: 20px;padding-top: 10px;">
								<font color="#676767">发布日期：2017-11-13</font>
							</div>
						</div>
					</div>
				</div>
				<div class="content-text">如眼所见是一个图像样式，必须写五十左右的文字作为这个文本框的空白填充，不写也是可以的，强迫症不能容忍空白。如眼所见是一个图像样式，必须写五十左右的文字作为这个文本框的空白填充，不写也是可以的，强迫症不能容忍空白。
				</div>
			</div>
			
			<div style="background-color: #F3F6F8;width: 550px;margin-left: -15px;">
				<div class="img"><img height="280px" src="/home/images/bg.jpg" />
				</div>
			</div>
			<div style="height: 25px;margin-left: 15px;">
				<font color="#666666">赞 (3435)&nbsp;▪&nbsp;评论 (298)</font>
			</div>
			<div style="width: 520px;border: 1px solid #E6E9EC;"></div>
			<div style="height: 40px;">
				<span style="height: 30px;width: 30px;margin-left: 20px;padding-top: 10px;" class="glyphicon glyphicon-thumbs-up"></span>
				<span style="height: 30px;width: 30px;margin-left: 10px;padding-top: 10px;margin-right: 15px;" class="glyphicon glyphicon-pencil"></span>
			</div>
		</div>	


		<div class="post-album">
			<div class="content">
				<div class="content-info row">
					<div id="avatar" class="col-lg-2" style="margin-right: -5px;"><img width="50px" src="/home/images/logo.png"></div>
					<div class="col-lg-10" style="height: 20px;margin-left:-15px;padding-top: 5px;">
						<b style="font-size: 20px">username</b>
						<div class="row">
							<div class="col-lg-6" style="height: 20px;padding-top: 10px;">
								<font color="#676767">发布日期：2017-11-13</font>
							</div>
						</div>
					</div>
				</div>
				<div class="content-text">如眼所见是一个图像样式，必须写五十左右的文字作为这个文本框的空白填充，不写也是可以的，强迫症不能容忍空白。如眼所见是一个图像样式，必须写五十左右的文字作为这个文本框的空白填充，不写也是可以的，强迫症不能容忍空白。
				</div>
			</div>
			<div style="background-color: #F3F6F8;width: 550px;margin-left: -15px;">
				<div class="img"><img height="280px" src="/home/images/bg.jpg" />
				</div>
			</div>
			<div style="height: 25px;margin-left: 15px;">
				<font color="#666666">赞 (3435)&nbsp;▪&nbsp;评论 (298)</font>
			</div>
			<div style="width: 520px;border: 1px solid #E6E9EC;"></div>
			<div style="height: 40px;">
				<span style="height: 30px;width: 30px;margin-left: 20px;padding-top: 10px;" class="glyphicon glyphicon-thumbs-up"></span>
				<span style="height: 30px;width: 30px;margin-left: 10px;padding-top: 10px;margin-right: 15px;" class="glyphicon glyphicon-pencil"></span>
			</div>
		</div>


		<div class="post-album">
			<div class="content">
				<div class="content-info row">
					<div id="avatar" class="col-lg-2" style="margin-right: -5px;"><img width="50px" src="/home/images/logo.png"></div>
					<div class="col-lg-10" style="height: 20px;margin-left:-15px;padding-top: 5px;">
						<b style="font-size: 20px">username</b>
						<div class="row">
							<div class="col-lg-6" style="height: 20px;padding-top: 10px;">
								<font color="#676767">发布日期：2017-11-13</font>
							</div>
						</div>
					</div>
				</div>
				<div class="content-text">如眼所见是一个图像样式，必须写五十左右的文字作为这个文本框的空白填充，不写也是可以的，强迫症不能容忍空白。如眼所见是一个图像样式，必须写五十左右的文字作为这个文本框的空白填充，不写也是可以的，强迫症不能容忍空白。
				</div>
			</div>
			<div style="background-color: #F3F6F8;width: 550px;margin-left: -15px;">
				<div class="img"><img height="280px" src="/home/images/bg.jpg" />
				</div>
			</div>
			<div style="height: 25px;margin-left: 15px;">
				<font color="#666666">赞 (3435)&nbsp;▪&nbsp;评论 (298)</font>
			</div>
			<div style="width: 520px;border: 1px solid #E6E9EC;"></div>
			<div style="height: 40px;">
				<span style="height: 30px;width: 30px;margin-left: 20px;padding-top: 10px;" class="glyphicon glyphicon-thumbs-up"></span>
				<span style="height: 30px;width: 30px;margin-left: 10px;padding-top: 10px;margin-right: 15px;" class="glyphicon glyphicon-pencil"></span>
			</div>
		</div>


		@foreach($data as $value)
		<div class="post-album">
			<div class="content">
				<div class="content-info row">
					<div id="avatar" class="col-lg-2" style="margin-right: -5px;"><img width="50px" src="/home/images/logo.png"></div>
					<div class="col-lg-10" style="height: 20px;margin-left:-15px;padding-top: 5px;">
						<b style="font-size: 20px">username</b>
						<div class="row">
							<div class="col-lg-6" style="height: 20px;padding-top: 10px;">
								<font color="#676767">发布日期：2017-11-13</font>
							</div>
						</div>
					</div>
				</div>
				<div class="content-text">{{$value->content}}</div>
			</div>
			<div style="background-color: #F3F6F8;width: 550px;margin-left: -15px;">
				<div class="img"><img height="280px" src="{{$value->img}}" />
				</div>
			</div>
			<div style="height: 25px;margin-left: 15px;">
				<font color="#666666">赞 (3435)&nbsp;▪&nbsp;评论 (298)</font>
			</div>
			<div style="width: 520px;border: 1px solid #E6E9EC;"></div>
			<div style="height: 40px;">
				<span style="height: 30px;width: 30px;margin-left: 20px;padding-top: 10px;" class="glyphicon glyphicon-thumbs-up"></span>
				<span style="height: 30px;width: 30px;margin-left: 10px;padding-top: 10px;margin-right: 15px;" class="glyphicon glyphicon-pencil"></span>
			</div>
		</div>
		@endforeach	



	</div>



</div>


<div id="result">结果：</div>
<br>
<br>
<br>
</body>
<script>
//发动态时显示缩略图
var form = new FormData();//通过HTML表单创建FormData对象
var url = '127.0.0.1:8080/'
function selectFile(){
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






// ajax发动态
$(function(){

	$('#addArticle').click(function(){
		// var content = $('#content').val();
		// var pic = $('#pic').val();
		var formData = new FormData(document.getElementById("dongtai"));
		// formData.append('content',content);
		// formData.append('pic',pic);
		$.ajax({
             type: "POST",
             url: "/home/article/add",  //同目录下的php文件
           
            data:formData,
            dataType:"json", //声明成功使用json数据类型回调
 
            //如果传递的是FormData数据类型，那么下来的三个参数是必须的，否则会报错
             cache:false,  //默认是true，但是一般不做缓存
             processData:false, //用于对data参数进行序列化处理，这里必须false；如果是true，就会将FormData转换为String类型
             contentType:false,  //一些文件上传http协议的关系，自行百度，如果上传的有文件，那么只能设置为false
             
             success: function(msg){  //请求成功后的回调函数
 
                $("#result").append("你的名字是"+msg.name+"，性别："+msg.sex+"，年龄："+msg.age+"，上传的文件名："+msg.file);
 
            }
        });




		// $.post('/home/article/add',$("form").serialize(),function(data){
		// 	if(data == '1'){
		// 		alert('发送成功');
		// 		// 刷新
	 //            parent.window.location = parent.window.location;
		// 	}else{
		// 		alert('失败');
		// 	}
			
		// });
	});
});
</script>
</html>