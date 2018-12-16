<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>"{{$text}}"|搜索</title>
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

<div class="container" style="background-color: #FFFFFF;padding-top: 50px;width: 960px;min-height: 620px;">

	<p style="font-size: 30px;font-weight: lighter;margin: 20px 0px;">"{{$text}}"|搜索</p>
	<h4 style="margin-bottom: 20px;color: gray;">{{$tot}}个结果</h4>
	<div style="border:1px solid gray;width: 930px;margin-bottom: 10px;"></div>
	
	@if($tot > 0)
		@foreach($data as $val)
			<div class="row" style="height: 110px;border-bottom:1px solid #C2C2C2;">
				<div class="col-lg-2">
					<a href="/home/article/{{$val->article_type}}/{{$val->id}}">
						<img src="{{$val->author_avatar}}" style="width: 65px;height: 65px;margin: 15px 20px 0px;">
					</a>
				</div>
				<div class="col-lg-10 row" style="margin-left: -60px;">
					<div class="col-lg-12" style="height: 35px;margin-top: 10px;">
						<a href="/home/article/{{$val->article_type}}/{{$val->id}}" style="font-size: 18px;color: #0977B3;">
							<b>{{$val->recruit_title}}</b>
						</a>
					</div>
					<div class="col-lg-12" style="font-size: 15px;height: 20px;">{{$val->author_name}}</div>
					<div class="col-lg-12" style="color: gray;font-size: 15px;">{{$val->province}}{{$val->city}}  &nbsp;2018-12-13 16:25:25</div>
				</div>
			</div>
		@endforeach
	@else
		<img src="/home/images/search.png">
	@endif
	

</div>
</body>
<script>

</script>
</html>