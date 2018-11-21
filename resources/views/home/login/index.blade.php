<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录页面</title>
	<link rel="stylesheet" href="/home/css/bootstrap.css">
	<script src="/home/js/jquery.min.js"></script>
	<script src="/home/js/bootstrap.min.js"></script>
	<script src="/home/js/layer.js"></script>
</head>
<body background="/home/images/bg.jpg">
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

	@if (Session::has('msg'))
	    <div class="alert alert-success">
	        <ul>
                <li>{{ Session::get('msg') }}</li>
	        </ul>
	    </div>
	@endif

	<div class="container" style="padding-top: 50px">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						登录
					</div>
					<div class="panel-body">
						<form action="/home/login/loginCheck" method="post">
							{{csrf_field()}}
							<div class="form-group">
								<span class="glyphicon glyphicon-envelope"></span>
								<label for="">EMAIL</label>
								<input class="form-control" type="text" name="email" id="">
							</div>
							<div class="form-group">
								<span class="glyphicon glyphicon-lock"></span>
								<label for="">PASSWORD</label>
								<input class="form-control" type="password" name="password" id="">
							</div>
							<div class="radio">
							   <label>
							      <input type="radio" name="loginType" id="optionsRadios1" value="company" checked> 企业
							   </label>
							   <label>
							      <input type="radio" name="loginType" id="optionsRadios1" value="member" > 用户
							   </label>
							</div>
							<div class="form-group">
								<input type="submit" class="btn btn-success" value="登录">
								<input type="reset" class="btn btn-danger" value="重置">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<!-- <script>
  //jquery的载入事件
  $(function(){ 
    @if (count($errors) > 0)
    //以javascript弹窗形式输出错误内容
        var allError = '';
        @foreach ($errors->all() as $error)
            allError += "{{$error}}<br/>"
        @endforeach
        //输出错误信息
        layer.alert(allError,{title:'错误提示',icon:5})
    @endif
  });
</script> -->
</html>