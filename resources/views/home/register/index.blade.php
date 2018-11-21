<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册页面</title>
	<link rel="stylesheet" href="/home/css/bootstrap.css">
	<script src="/home/js/jquery.min.js"></script>
	<script src="/home/js/bootstrap.min.js"></script>
</head>
<body>

	@if (count($errors) > 0)
	    <div class="alert alert-danger">
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif
	
	<div class="container" style="padding-top: 30px">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				
				<div class="panel panel-primary">
					<div class="panel-heading">
						注册
					</div>
					<div class="panel-body">
						<form action="/home/register/regCheck" method="post">
							{{csrf_field()}}
							<div class="form-group">
								<span class="glyphicon glyphicon-envelope"></span>
								<label for="">EMAIL</label>
								<input class="form-control" type="text" name="email">
							</div>
							<div class="form-group">
								<span class="glyphicon glyphicon-lock"></span>
								<label for="">PASSWORD</label>
								<input class="form-control" type="password" name="password">
							</div>
							<div class="form-group">
								<span class="glyphicon glyphicon-lock"></span>
								<label for="">REPASSWORD</label>
								<input class="form-control" type="password" name="password_confirmation">
							</div>
							<div class="form-group">
								<span class="glyphicon glyphicon-earphone"></span>
								<label for="">MOBILE</label>
								<input class="form-control" type="text" name="mobile">
							</div>
							<div class="form-group">
								<span class="glyphicon glyphicon-cloud"></span>
								<label for="">CODE</label>
								<input class="form-control" type="text" name="captcha" style="margin-bottom: 10px">
								<img src="{{captcha_src()}}"><a id="huan" href="javascript:;">看不清，换一张</a>
							</div>

							<div class="form-group">
								<input type="hidden" id="regType" name="regType" value="company">
								<input type="submit" class="btn btn-primary" value="注册_企业账户">&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" id="member" class="btn btn-primary" value="注册_普通用户">&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="reset" class="btn btn-danger" value="重&nbsp;&nbsp;&nbsp;&nbsp;置">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script>
	//jquery载入事件
	$(function(){
		//获取验证码地址
		var src = $('img').attr('src');
		//给超链接绑定事件
		$('#huan').click(function(){
			$('img').attr('src',src + '&=' + Math.random());
		});


		//修改注册状态隐藏域的值
		$('#member').click(function(){
			$('#regType').val('member');
		});




	});
</script>
</html>