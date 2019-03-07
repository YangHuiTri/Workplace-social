<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>职位推荐</title>
<link rel="stylesheet" href="/home/css/bootstrap.min.css">
<script src="/home/js/jquery.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<style type="text/css">
	.thumbnail{
		height: 240px;
	}

    .thumbnail:hover{
        -webkit-box-shadow: #ccc 0px 3px 3px;
        -moz-box-shadow: #ccc 0px 3px 3px;
        box-shadow: #ccc 0px 3px 3px;  
    }

    .caption{
    	word-wrap: break-word;word-break: break-all;overflow: hidden;
    }
</style>
</head>
<body style="background-color: #F5F5F5;">

<nav class="navbar navbar-default navbar-fixed-top" style="background-color: #283E4A;">
    <div class="container-fluid">
	    <div class="navbar-header">
	        <a class="navbar-brand" href="/" style="text-decoration: none;color: white;">
	            Workplace
	        </a>
	    </div>
	</div>
</nav>

<div class="container" style="background-color: #FFFFFF;padding-top: 50px;">

	<p style="font-size: 30px;font-weight: lighter;margin: 20px 0px;">职位推荐</p>
	<h4 style="margin-bottom: 20px;"><b>根据您的职业档案和求职偏好为您推荐</b></h4>

	<div class="row">
		@if(!empty($data2))
			@foreach($data2 as $val)
		    <div class="col-sm-4 col-md-3">
		    	<a href="/home/article/{{$val->article_type}}/{{$val->id}}" style="text-decoration: none;">
			        <div class="thumbnail">
			        	<div class="caption" style="height: 160px;">
			          		<h4><b>{{$val->recruit_title}}</b></h4>
			          		<p>{{$val->author_name}}</p>
			        	</div>
				        <div style="margin-left: 5px;" class="row">
				        	<span style="color: green;" class="glyphicon glyphicon-time col-lg-5"><font style="color: gray;">抢先申请</font></span>
				        	<span class="glyphicon glyphicon-map-marker col-lg-7"><font style="color: gray;">{{$val->work_province}}▪{{$val->work_city}}</font></span>
				        </div>
		            	<div style="border:1px solid gray;width: 250px;margin: 10px 0px;"></div>
		            	<p style="color: gray;">{{$val->created_at}}</p>
			        </div>
			    </a>
		    </div>
		    @endforeach
	    @else
	    	<hr>
			<center><h2>暂无推荐，尝试先更新个人求职信息</h2></center>
	    	<center><img src="/home/images/collection.png"></center>
    	@endif

	    <!-- @for($i=1;$i<=6;$i++)
	    <div class="col-sm-4 col-md-3">
	    	<a href="#" style="text-decoration: none;">
		        <div class="thumbnail">
		        	<div class="caption" style="height: 160px;">
		          		<h4><b>学术推广员</b></h4>
		          		<p>西双版纳雨林制药有限责任公司</p>
		        	</div>
		        	<div style="margin-left: 5px;" class="row">
			        	<span style="color: green;" class="glyphicon glyphicon-time col-lg-6"><font style="color: gray;">抢先申请</font></span>
			        	<span class="glyphicon glyphicon-map-marker col-lg-6"><font style="color: gray;">江西▪南昌</font></span>
			        </div>
	            	<div style="border:1px solid gray;width: 240px;margin: 10px 0px;"></div>
	            	<p style="color: gray;">2018-12-5 14:29:35</p>
		        </div>
		    </a>
	    </div>
	    @endfor -->

	</div>

</div>
</body>
<script>

</script>
</html>