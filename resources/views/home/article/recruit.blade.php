<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>{{$data[0]->recruit_title}}-{{$data['0']->author_name}}</title>
	<link rel="stylesheet" href="/home/css/bootstrap.min.css">
	<script src="/home/js/jquery.min.js"></script>
	<script src="/home/js/bootstrap.min.js"></script>
 	<style type="text/css">
		.post-album {
			max-width: 790px;
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
		.content-text{
			color: #666666;
			line-height: 30px;
			font-size: 16px;


			/*overflow:hidden; 
			text-overflow:ellipsis;
			display:-webkit-box; 
			-webkit-box-orient:vertical;
			-webkit-line-clamp:3; */
		}
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
<body style="background-color: #EDEDED">
	<div class="container" style="margin-bottom: 20px;">
		
		<div class="post-album" style="height: 190px;">
			<div class="content">
				<div class="row">
					<div class="col-lg-2" >
						<img width="120px" style="height: 120px;" src="{{$data['0']->author_avatar}}">
					</div>
					<div class="col-lg-10">
						<b style="font-size: 20px;margin-left: 20px;">{{$data['0']->recruit_title}}</b>
						<div class="row" style="margin-left: 5px;">
							<div class="col-lg-12" style="padding-top: 10px;">
								<font color="#676767" style="font-size: 20px;">{{$data['0']->author_name}}</font>
							</div>
							<div class="col-lg-12" style="padding-top: 10px;">
								<font color="#676767">发布日期：{{$data['0']->created_at}}</font>
							</div>
							@if(Session::get('loginType') == 'member')
								<div class="col-lg-12" style="padding-top: 20px;">
									<button id="shoucang" class="btn btn-default" style="border:1px solid #0073B1;color: #0073B1;height: 40px;min-width: 65px;font-size: 18px;"><?php if(in_array($data['0']->id, $collectionArr)){echo "取消收藏";}else{echo "收藏";}?></button>&nbsp;&nbsp;

									<button id="shenqing" class="btn btn-primary" style="height: 40px;min-width: 80px;font-size: 18px;"><?php if(in_array($data['0']->id, $applicationArr)){echo "取消申请";}else{echo "申请";}?></button>
								</div>
							@endif
							
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="post-album">
			<div class="content">
				

				<div class="row" style="height: 40px;">
					<div class="col-lg-2" style="height: 30px;">
						<span style="font-size: 15px;font-weight: bold;">职位性质：</span>
					</div>
					<div class="col-lg-10" style="margin-left: -50px;">
						@if($data['0']->category_id == 1)
							全职
						@elseif($data['0']->category_id == 2)
							实习
						@else
							兼职
						@endif
					</div>
				</div>

				<div class="row" style="height: 40px;">
					<div class="col-lg-2" style="height: 30px;">
						<span style="font-size: 15px;font-weight: bold;">职能类别：</span>
					</div>
					<div class="col-lg-10" style="margin-left: -50px;">
						{{$data3['category_name']}}
					</div>
				</div>

				<div class="row" style="height: 40px;">
					<div class="col-lg-2" style="height: 30px;">
						<span style="font-size: 15px;font-weight: bold;">工作城市：</span>
					</div>
					<div class="col-lg-10" style="margin-left: -50px;">
						{{$data3['work_province']}}{{$data3['work_city']}}
					</div>
				</div>

				<div class="row" style="height: 40px;">
					<div class="col-lg-12" style="height: 30px;">
						<span style="font-size: 15px;font-weight: bold;">资历要求</span>
					</div>
					<div class="col-lg-12">
						<span class="col-lg-3">
							学历：
							@if($data['0']->education == 0)
								其他
							@elseif($data['0']->education == 1)
								高中
							@elseif($data['0']->education == 2)
								大专
							@elseif($data['0']->education == 3)
								本科
							@elseif($data['0']->education == 4)
								硕士
							@elseif($data['0']->education == 5)
								博士
							@else
								无
							@endif
						</span>
						<span class="col-lg-3">
							工作经验：
							@if($data['0']->work_experience == 0)
								无
							@else
								{{$data['0']->work_experience}} 年
							@endif
						</span>
					</div>
				</div>

				<br>
				<div style="width: 760px;border: 1px solid gray;margin-left: -20px;"></div>
				<font style="font-size: 20px;">职位描述</font>
				<div class="content-text">{!!$data['0']->content!!}</div>
				<br>
				<div style="width: 760px;border: 1px solid gray;margin-left: -20px;"></div>
				<font style="font-size: 20px;">联系我们</font>
				<div class="content-text">电话：{{$data3['mobile']}}</div>
				<div class="content-text">地址：{{$data3['country']}}-{{$data3['province']}}-{{$data3['city']}}-{{$data3['county']}}&nbsp;&nbsp;&nbsp;&nbsp;{{$data['0']->author_name}}</div>
				<br>
				<div style="width: 760px;border: 1px solid gray;margin-left: -20px;"></div>
				<font style="font-size: 20px;">公司简介</font>
				<div class="content-text">{!!$data3['introduction']!!}</div>
			</div>
		</div>

		@if(Session::get('loginType') == 'company')
			@if(Auth::guard('company')->user()->id == $data['0']->author_id)
			<div style="background-color: white;margin: 20px auto 0;border-radius: 6px;max-width: 790px;">
				<span style="font-size: 23px;margin: 10px;position: absolute;">为您推荐：</span><button id="getOther" class="btn btn-default glyphicon glyphicon-refresh" style="float: right;margin: 10px;" title="换一批"></button><br><br><br>
				<div class="row tuijian" style="margin: 0px 5px;">
					<span class="target"></span>

					@foreach($data4 as $val)
					    <div class="col-sm-4 col-md-3 more" style="text-align: center;">
					        <div class="thumbnail">
					        	<div class="caption" style="height: 130px;">
					        		<img src="{{$val['0']->avatar}}" style="width: 80px;height: 80px;border-radius: 50%;">
					        		<h4><b>{{$val['0']->username}}</b></h4>
					        	</div>
					        	<span style="color: #616263;" class="glyphicon glyphicon-home">{{$val['0']->school}}</span><br><br>
					        	<a href="/home/homepage/resume/{{$val['0']->id}}" class="btn btn-default" style="border:1px solid #0073B1; color: #0073B1">点击查看</a>
					        </div>
					    </div>
				    @endforeach

				</div>
			</div>
			@endif
		@endif



		<div style="margin-top: 20px;"><center>Copyright © 2010 - 2018 Workplace-social. All Rights Reserved.</center></div>

	
	</div>
</body>
<script>
$(function(){
	//申请、取消申请职位
	$('#shenqing').click(function(){
		if($('#shenqing').text() == '申请'){
			$.get('/home/article/shenqing',{'id':'{{$data['0']->id}}','com_id':'{{$data['0']->author_id}}','type':'add'},function(data){
				if(data == '1'){
					$('#shenqing').text('取消申请');
				}
			});
		}else{
			$.get('/home/article/shenqing',{'id':'{{$data['0']->id}}','com_id':'{{$data['0']->author_id}}','type':'less'},function(data){
				if(data == '1'){
					$('#shenqing').text('申请');
				}	
			});
		}

	});

	//收藏、取消收藏
	$('#shoucang').click(function(){
		if($('#shoucang').text() == '收藏'){
			$.get('/home/collection/add',{'id':'{{$data['0']->id}}'},function(data){
				if(data == '1'){
					$('#shoucang').text('取消收藏');
				}
			});
		}else{
			$.get('/home/collection/less',{'id':'{{$data['0']->id}}'},function(data){
				if(data == '1'){
					$('#shoucang').text('收藏');
				}
			});
		}
		
	});

	$('#getOther').on('click',function(){
		var id = {{$data['0']->id}};//文章id
		$.post('/home/article/getOther',{'id':id, '_token':'{{csrf_token()}}'},function(data){
			if(data){
				$('.more').html('');
				for(i=0;i<data.length;i++){
					$('.target').after('<div class="col-sm-4 col-md-3 more" style="text-align: center;"><div class="thumbnail"><div class="caption" style="height: 130px;"><img src="'+data[i].avatar+'" style="width: 80px;height: 80px;border-radius: 50%;"><h4><b>'+data[i].username+'</b></h4></div><span style="color: #616263;" class="glyphicon glyphicon-home">'+data[i].school+'</span><br><br><a href="/home/homepage/resume/'+data[i].id+'" class="btn btn-default" style="border:1px solid #0073B1; color: #0073B1">点击查看</a></div></div>');
				}
			}
		});
	});



});	
</script>
</html>