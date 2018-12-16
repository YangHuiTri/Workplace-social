<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>收藏</title>
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

	<p style="font-size: 30px;font-weight: lighter;margin: 20px 0px;">收藏</p>
	<h4 style="margin-bottom: 20px;"><b>您收藏的招聘信息都在这里</b></h4>

	<div class="row">
		
		@if($data != 'nothing')
		    @foreach($data as $val)
		    <div class="col-sm-4 col-md-3">
		    	<a href="/home/article/{{$val['0']->article_type}}/{{$val['0']->id}}" style="text-decoration: none;">
			        <div class="thumbnail">
			        	<div class="caption" style="height: 160px;">
			          		<h4><b>{{$val['0']->recruit_title}}</b></h4>
			          		<p>{{$val['0']->author_name}}</p>
			        	</div>
			        	<div style="margin-left: 5px;" class="row">
				        	<span style="color: green;" class="glyphicon glyphicon-time col-lg-5"><font style="color: gray;">抢先申请</font></span>
				        	<span class="glyphicon glyphicon-map-marker col-lg-7"><font style="color: gray;">{{$val['0']->province}}▪{{$val['0']->city}}</font></span>
				        </div>
		            	<div style="border:1px solid gray;width: 240px;margin: 10px 0px;"></div>
		            	<p style="color: gray;">{{$val['0']->created_at}}</p>
			        </div>
			    </a>
		    </div>
		    @endforeach
	    @else
	    	<center><img src="/home/images/collection.png"></center>
	    @endif

	</div>

</div>
</body>
<script>

</script>
</html>