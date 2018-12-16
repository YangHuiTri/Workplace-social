<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>个人履历 - {{$res['0']->username}}</title>

<!-- 导入jsPDF -->
<script src="/home/js/html2canvas.js"></script>
<script src="/home/js/jsPdf.debug.js"></script>

<link rel="stylesheet" href="/home/css/bootstrap.min.css">
<script src="/home/js/jquery.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<style type="text/css">
	.row{
		margin: 5px;
		font-size: 15px;
		color: #777777;
		line-height: 40px;
	}
	input{
		text-align: center;
	}
	.headers{
		font-size: 20px;
	}
</style>
</head>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<body style="background-color: #F5F5F5;">
	<div style="padding-left: 880px;padding-top: 50px;position: absolute;"><button class="btn btn-primary" id="download">下载简历</button></div>
	<div class="container" style="background-color: white;width: 850px;margin-top: 20px;" id="pdf">

		<div class="page-header">
		  <h1>Personal Resume <small>Take a minute to look</small></h1>
		</div>

		
		<!-- 基本信息 -->
		<div class="basic" style="border-bottom: 1px solid black;min-height: 100px;">
			<span class="headers">个人信息</span>
			<div class="row">
				<span class="col-lg-4">姓名：{{$res['0']->username}}</span>
				<span class="col-lg-4">性别：
					@if($res['0']->gender == '1')
						男
					@elseif($res['0']->gender == '2')
						女
					@else
						保密
					@endif
				</span>
				<span class="col-lg-4">籍贯：{{$data['province']}}{{$data['city']}}</span>
				<span class="col-lg-4">年龄：{{$res['0']->age}}</span>
				<span class="col-lg-4">手机：{{$res['0']->mobile}}</span>
				<span class="col-lg-4">邮箱：{{$res['0']->email}}</span>
				<span class="col-lg-4">学校：{{$data['school']}}</span>
				<span class="col-lg-4">专业：{{$res['0']->profession}}</span>
				<span class="col-lg-4">学历：
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
					@elseif($res['0']->education == '6')
						其他
					@endif
				</span>
			</div>
		</div>


		<!-- 教育背景 -->
		<div class="education" style="border-bottom: 1px solid black;margin: 10px 0px;min-height: 100px;">
			<span class="headers">教育背景</span>
			<!-- 新增教育背景 -->
			@if(Session::get('loginType') == 'member' && Auth::guard('member')->user()->id == $res['0']->id)
				<a class="add-project" data-toggle="modal" data-target="#exampleModal_education" data-whatever="@mdo" style="text-decoration: none;cursor: pointer;">
					<span style="float: right;margin-right: 30px;">✚ 新增</span>
				</a>
			@endif
			<!-- 教育背景展示 -->
			<div class="row">
				@if(count($education) > 0)
					@foreach($education as $val)
					<span class="col-lg-2">{{$val->start_time}}</span>
					<span class="col-lg-1">--</span>
					<span class="col-lg-2"">{{$val->end_time}}</span>
					<span class="col-lg-7" style="text-align: center;">{{$val->title}}</span>
					@endforeach
				@else
					<center>暂无</center>
				@endif
			</div>
		</div>
		<!-- 添加教育背景--模态框 -->
		<div class="modal fade" id="exampleModal_education" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
			       		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="exampleModalLabel">New message</h4>
			      	</div>
			      	<div class="modal-body">
			        	<form action="" method="post" id="education">
				        	{{csrf_field()}}
							<input type="month" name="start_time" style="width: 120px;">
							<label style="height:40px;text-align: center;">----</label>
							<input type="month" name="end_time" style="width: 120px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="text" name="title" placeholder="学校名" style="height: 40px;width: 260px;">
							<input type="hidden" name="type" value="education">	
						    <div class="modal-footer">
						        <button type="button" class="btn btn-primary baocun" id="add_education">保存</button>
						    </div>
				      	</form>
		      		</div>
		    	</div>
		  	</div>
		</div>
		<!-- 添加教育背景--模态框--结束 -->

	
		<!-- 工作经验 -->
		<div class="work" style="border-bottom: 1px solid black;margin: 10px 0px;min-height: 100px;">
			<span class="headers">工作经验</span>
			<!-- 新增项目经验 -->
			@if(Session::get('loginType') == 'member' && Auth::guard('member')->user()->id == $res['0']->id)
				<a class="add-project" data-toggle="modal" data-target="#exampleModal_work" data-whatever="@mdo" style="text-decoration: none;cursor: pointer;">
					<span style="float: right;margin-right: 30px;">✚ 新增</span>
				</a>
			@endif
			<!-- 工作经验展示 -->
			@if(count($work) > 0)
				@foreach($work as $val)
				<div class="row">
					<span class="col-lg-2">{{$val->start_time}}</span>
					<span class="col-lg-1">--</span>
					<span class="col-lg-2"">{{$val->end_time}}</span>
					<span class="col-lg-4" style="text-align: center;">{{$val->title}}</span>
					<span class="col-lg-3">{{$val->duty}}</span>
					<span class="col-lg-12">{!!$val->content!!}</span>
				</div>
				<div style="height: 1px;background-color: gray;margin: auto;border-top:1px silver dashed;"></div>
				@endforeach
			@else
				<center><span style="color: #777777;font-size: 15px;">暂无</span></center>
			@endif
		</div>
		<!-- 添加工作经验--模态框 -->
		<div class="modal fade bs-example-modal-lg" id="exampleModal_work" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  	<div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
			       		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="exampleModalLabel">New message</h4>
			      	</div>
			      	<div class="modal-body">
			        	<form action="" method="post" id="work">
				        	{{csrf_field()}}
					        <table class="table">
								<tr>
									<td>
										<input type="month" name="start_time">
									</td>
									<td><label style="height:40px;">______</label></td>
									<td>
										<input type="month" name="end_time">
									</td>
									<td>
										<input type="text" name="title" placeholder="公司名" style="height: 40px;">
									</td>
									<td>
										<input type="text" name="duty" placeholder="职位" style="height: 40px;">
										<input type="hidden" name="type" value="work">
									</td>
								</tr>
								<tr>
									<td colspan="5">
										<textarea name="content" placeholder="工作描述..." style="width: 830px;height: 200px;"></textarea>
									</td>
								</tr>
							</table>
						    <div class="modal-footer">
						        <button type="button" class="btn btn-primary baocun" id="add_work">保存</button>
						    </div>
				      	</form>
		      		</div>
		    	</div>
		  	</div>
		</div>
		<!-- 添加工作经验--模态框--结束 -->


		<!-- 项目经验 -->
		<div class="project" style="border-bottom: 1px solid black;margin: 10px 0px;min-height: 100px;">
			<span class="headers">项目经验</span>
			<!-- 新增项目经验 -->
			@if(Session::get('loginType') == 'member' && Auth::guard('member')->user()->id == $res['0']->id)
				<a class="add-project" data-toggle="modal" data-target="#exampleModal_project" data-whatever="@mdo" style="text-decoration: none;cursor: pointer;">
					<span style="float: right;margin-right: 30px;">✚ 新增</span>
				</a>
			@endif
			<!-- 项目经验展示 -->
			@if(count($project) > 0)
				@foreach($project as $val)
				<div class="row">
					<span class="col-lg-2">{{$val->start_time}}</span>
					<span class="col-lg-1">--</span>
					<span class="col-lg-2"">{{$val->end_time}}</span>
					<span class="col-lg-4" style="text-align: center;">{{$val->title}}</span>
					<span class="col-lg-3">{{$val->duty}}</span>
					<span class="col-lg-12">{!!$val->content!!}</span>
				</div>
				<div style="height: 1px;background-color: gray;margin: auto;border-top:1px silver dashed;"></div>
				@endforeach
			@else
				<center><span style="color: #777777;font-size: 15px;">暂无</span></center>
			@endif
		</div>
		<!-- 添加项目经验--模态框 -->
		<div class="modal fade bs-example-modal-lg" id="exampleModal_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  	<div class="modal-dialog modal-lg" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
			       		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="exampleModalLabel">New message</h4>
			      	</div>
			      	<div class="modal-body">
			        	<form action="" method="post" id="project">
				        	{{csrf_field()}}
					        <table class="table">
								<tr>
									<td>
										<input type="month" name="start_time">
									</td>
									<td><label style="height:40px;text-align: center;">______</label></td>
									<td>
										<input type="month" name="end_time">
									</td>
									<td>
										<input type="text" name="title" placeholder="项目名" style="height: 40px;">
									</td>
									<td>
										<input type="text" name="duty" placeholder="项目职责" style="height: 40px;">
										<input type="hidden" name="type" value="project">
									</td>
								</tr>
								<tr>
									<td colspan="5">
										<textarea name="content" placeholder="项目描述..." style="width: 830px;height: 200px;"></textarea>
									</td>
								</tr>
							</table>
						    <div class="modal-footer">
						        <button type="button" class="btn btn-primary baocun" id="add_project">保存</button>
						    </div>
				      	</form>
		      		</div>
		    	</div>
		  	</div>
		</div>
		<!-- 添加项目经验--模态框--结束 -->


		<!-- 专业技能 -->
		<div class="skill" style="border-bottom: 1px solid black;margin: 10px 0px;min-height: 100px;">
			<span class="headers">专业技能</span>
			<!-- 新增项目经验 -->
			@if(Session::get('loginType') == 'member' && Auth::guard('member')->user()->id == $res['0']->id)
				<a class="add-project" data-toggle="modal" data-target="#exampleModal_skill" data-whatever="@mdo" style="text-decoration: none;cursor: pointer;">
					<span style="float: right;margin-right: 30px;">✚ 新增</span>
				</a>
			@endif
			<!-- 专业技能展示 -->
			@if(count($skill) > 0)
				@foreach($skill as $val)
				<div class="row">
					<span class="col-lg-2">{{$val->start_time}}</span>
					<span class="col-lg-1">--</span>
					<span class="col-lg-2"">{{$val->end_time}}</span>
					<span class="col-lg-7" style="text-align: center;">{{$val->title}}</span>
					<span class="col-lg-12">{!!$val->content!!}</span>
				</div>
				<div style="height: 1px;background-color: gray;margin: auto;border-top:1px silver dashed;"></div>
				@endforeach
			@else
				<center><span style="color: #777777;font-size: 15px;">暂无</span></center>
			@endif
		</div>
		<!-- 添加专业技能--模态框 -->
		<div class="modal fade" id="exampleModal_skill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
			       		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="exampleModalLabel">New message</h4>
			      	</div>
			      	<div class="modal-body">
			        	<form action="" method="post" id="skill">
				        	{{csrf_field()}}
							<input type="month" name="start_time" style="width: 120px;">
							<label style="height:40px;text-align: center;">----</label>
							<input type="month" name="end_time" style="width: 120px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="text" name="title" placeholder="技能证书" style="height: 40px;width: 260px;">
							<input type="hidden" name="type" value="skill">
							<textarea name="content" placeholder="技能描述" style="width: 560px;height: 150px;"></textarea>
						    <div class="modal-footer">
						        <button type="button" class="btn btn-primary baocun" id="add_skill">保存</button>
						    </div>
				      	</form>
		      		</div>
		    	</div>
		  	</div>
		</div>
		<!-- 添加专业技能--模态框--结束 -->

		
		<!-- 相关证书 -->
		<div class="certificate" style="border-bottom: 1px solid black;margin: 10px 0px;min-height: 100px;">
			<span class="headers">相关证书</span>
			<!-- 新增相关证书 -->
			@if(Session::get('loginType') == 'member' && Auth::guard('member')->user()->id == $res['0']->id)
				<a class="add-project" data-toggle="modal" data-target="#exampleModal_certificate" data-whatever="@mdo" style="text-decoration: none;cursor: pointer;">
					<span style="float: right;margin-right: 30px;">✚ 新增</span>
				</a>
			@endif
			<div class="row">
				@if(count($certificate) > 0)
					@foreach($certificate as $val)
					<span class="col-lg-3">{{$val->title}}</span>
					@endforeach
				@else
					<center>暂无</center>
				@endif
			</div>
		</div>
		<!-- 添加相关证书--模态框 -->
		<div class="modal fade" id="exampleModal_certificate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
		  	<div class="modal-dialog" role="document">
		    	<div class="modal-content">
			      	<div class="modal-header">
			       		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        	<h4 class="modal-title" id="exampleModalLabel">New message</h4>
			      	</div>
			      	<div class="modal-body">
			        	<form action="" method="post" id="certificate">
				        	{{csrf_field()}}
					        <input type="text" name="title" style="width: 550px;height: 40px;" placeholder="证书">
					        <input type="hidden" name="type" value="certificate">
						    <div class="modal-footer">
						        <button type="button" class="btn btn-primary baocun" id="add_certificate">保存</button>
						    </div>
				      	</form>
		      		</div>
		    	</div>
		  	</div>
		</div>
		<!-- 添加相关证书--模态框--结束 -->


		<!-- 个人简介 -->
		<div class="introduction" style="margin: 10px 0px;min-height: 100px;">
			<span class="headers">个人简介</span>
			<div class="row">
				<div class="col-lg-12">
					@if(isset($res['0']->introduction))
						{{$res['0']->introduction}}
					@else
						<center><span style="color: #777777;font-size: 15px;">暂无</span></center>
					@endif
				</div>
			</div>
		</div>
		

	</div>
</body>
<script>
$(function(){
	//下载简历
	$('#download').click(function(){
		//下载前将新增按钮和下载按钮隐藏
		$('.add-project').hide();
		$('#download').hide();
		if(confirm("您确认下载该PDF文件吗?")){
	        var pdf = new jsPDF('p','pt','a4');
	    	// 设置打印比例 越大打印越小
	        pdf.internal.scaleFactor = 2;
	        var options = {
	            pagesplit: true, //设置是否自动分页
	            "background": '#FFFFFF'   //如果导出的pdf为黑色背景，需要将导出的html模块内容背景 设置成白色。
	        };
	        var printHtml = $('#pdf').innerHtml;   // 页面某一个div里面的内容，通过id获取div内容
	        pdf.addHTML(printHtml,15, 15, options,function() {
	            pdf.save("简历_{{$res['0']->username}}.pdf");
	        });
	    }
	    //下载完将新增按钮和下载按钮恢复显示
	    $('.add-project').show();
	    $('#download').show();
	});

	// ajax添加工作经验
	$('.baocun').click(function(){
		var id = $(this).attr('id');
		var form_id = id.substring(4);
		//利用formdata将表单数据传输到指定路径
		var formData = new FormData(document.getElementById(form_id));
		$.ajax({
            type: "POST",
            url: "/home/homepage/addResume",  //同目录下的php文件
            data:formData,
            dataType:"json", //声明成功使用json数据类型回调
 
            //如果传递的是FormData数据类型，那么下来的三个参数是必须的，否则会报错
            cache:false,  //默认是true，但是一般不做缓存
            processData:false, //用于对data参数进行序列化处理，这里必须false；如果是true，就将FormData转换为String类型
            contentType:false,  //一些文件上传http协议的关系，自行百度，如果上传的有文件，那么只能设置为false
            success: function(data){  //请求成功后的回调函数
            	if(data){
            		alert('保存成功');
            		// parent.window.location = parent.window.location;
            		window.location.reload();
            	}else{
            		alert('保存失败');
            	}
            }
        });
	});





});
</script>
</html>