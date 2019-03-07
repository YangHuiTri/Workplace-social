<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<link rel="stylesheet" href="/home/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--/meta 作为公共模版分离出去-->

<title>设置</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<article class="container page-container">
	@if(Session::get('loginType') == 'member')
		<h3>求职偏好设置</h3>
		<form action="" method="post" class="form form-horizontal" id="form-member-add">
	        <div class="row cl">
	            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>期望城市：</label>
	            <div class="formControls col-xs-8 col-sm-9"> 
	            	<span class="select-box" style="width:110px;">
					<select class="select" name="province_id" size="1">
						<option value="0">省份/州</option>
						@foreach($province as $val)
						<option value="{{$val -> id}}">{{$val -> area}}</option>
						@endforeach
					</select>
					</span>
					<span class="select-box" style="width:110px;">
					<select class="select" name="city_id" size="1">
						<option value="0">城市</option>
					</select>
					</span>  
				</div>
	        </div>

	        <div class="row cl">
	            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>职能性质：</label>
	            <div class="formControls col-xs-8 col-sm-9"> 
	            	<span class="select-box" style="width:110px;">
					<select class="select" name="recruit_type" size="1">
						<option value="">请选择</option>
						<option value="1">全职</option>
						<option value="2">实习</option>
						<option value="3">兼职</option>
					</select>
					</span>
				</div>
			</div>

			<div class="row cl">
	            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>职能类别：</label>
	            <div class="formControls col-xs-8 col-sm-9"> 
	            	<span class="select-box" style="width:200px;">
					<select class="select" name="category_id" size="1">
						<option value="">请选择</option>
						@foreach($category as $val)
						<option value="{{$val->id}}">{{$val->category_name}}</option>
						@endforeach
					</select>
					</span>
				</div>
			</div>

			<div class="row cl">
	            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>目前状态：</label>
	            <div class="formControls col-xs-8 col-sm-9"> 
	            	<span class="select-box" style="width:110px;">
					<select class="select" name="status" size="1">
						<option value="">请选择</option>
						<option value="1">正在找工作</option>
						<option value="2">准备换工作</option>
						<option value="3">已经找到工作</option>
					</select>
					</span>
				</div>
			</div>

			{{ csrf_field() }}
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
					<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;保存&nbsp;&nbsp;">
				</div>
			</div>
		</form>


		<h3>隐私设置</h3>
		<div class="row">
			<div class="col-lg-4" style="font-size: 15px;">
				<center>是否被推荐</center>
			</div>
			<div class="col-lg-8">
				@if($is_recommend == '2')
					<button id="tuijian" class="btn btn-primary" style="width: 50px;">是</button>
				@else
					<button id="tuijian" class="btn" style="width: 50px;">否</button>
				@endif
			</div>
		</div>
	@elseif(Session::get('loginType') == 'company')
		<h3>隐私设置</h3>
		<div class="row">
			<div class="col-lg-4" style="font-size: 15px;">
				<center>是否接收求职信息</center>
			</div>
			<div class="col-lg-8">
				@if($is_receive == '2')
					<button id="jieshou" class="btn btn-primary" style="width: 50px;">是</button>
				@else
					<button id="jieshou" class="btn" style="width: 50px;">否</button>
				@endif
			</div>
		</div>
	@endif

</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	//在选择省份/州之后列出城市的数据
	$('select[name=province_id]').change(function(){
		//获取当前省份/州id
		var id = $(this).val();
		$.get('/home/edit/getareabyid',{id: id},function(data){
			//jQuery的循环操作
			var str = '';
			$.each(data,function(index,el){
				str += "<option value='" + el.id + "'>" + el.area + "</option>";
			});
			//在追加之前先清除之前的三级之后的数据
			$('select[name=city_id]').find('option:gt(0)').remove();
			$('select[name=county_id]').find('option:gt(0)').remove();
			//将数据放到对应的option之后
			$('select[name=city_id]').append(str);
		},'json');
	});

	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			province_id:{
				required:true,
			},
			city_id:{
				required:true,
			},
			category_id:{
				required:true,
			},
			recruit_type:{
				required:true,
			},
			status:{
				required:true,
			},	
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
            $(form).ajaxSubmit({
                type: 'post',
                url: "/home/setting/expect",//自己提交给自己可以不写url
                success: function(data) {
                    //判断添加结果
                    if(data){
                    	layer.msg('修改成功!', { icon: 1, time: 2000 },function(){
                        	var index = parent.layer.getFrameIndex(window.name);
			                // parent.$('.btn-refresh').click();
			                window.location.href="/home/homepage/index/{{Session::get('loginType')}}/"+data;
			                // 刷新
			                // parent.window.location = parent.window.location;
			                parent.layer.close(index);
                        });
                    }else{
                    	layer.msg('修改失败!', { icon: 2, time: 2000 });
                    }
                },
                error: function(XmlHttpRequest, textStatus, errorThrown) {  
                    layer.msg('error!', { icon: 2, time: 1000 });
                }
            });
		}
	});

	//ajax设置是否被推荐
	$('#tuijian').click(function(){
		var tuijian = $(this).attr('class');
		if(tuijian == 'btn btn-primary'){
			//关闭推荐
			$.get('/home/setting/tuijian',{'command':'off'},function(data){
				if(data == '1'){
					layer.alert('已关闭');
					$('#tuijian').attr('class','btn');
					$('#tuijian').text('否');
				}else{
					layer.alert('关闭失败')
				}
			});
		}else if(tuijian == 'btn'){
			//打开推荐
			$.get('/home/setting/tuijian',{'command':'on'},function(data){
				if(data == '1'){
					layer.alert('已打开');
					$('#tuijian').attr('class','btn btn-primary');
					$('#tuijian').text('是');
				}else{
					layer.alert('打开失败')
				}
			});
		}
	});

	//ajax设置是否接收求职信息
	$('#jieshou').on('click',function(){
		var jieshou = $(this).attr('class');
		if(jieshou == 'btn btn-primary'){
			//关闭接收
			$.get('/home/setting/jieshou',{'command':'off'},function(data){
				if(data == '1'){
					layer.alert('已关闭');
					$('#jieshou').attr('class','btn');
					$('#jieshou').text('否');
				}else{
					layer.alert('关闭失败')
				}
			});
		}else if(jieshou == 'btn'){
			//打开接收
			$.get('/home/setting/jieshou',{'command':'on'},function(data){
				if(data == '1'){
					layer.alert('已打开');
					$('#jieshou').attr('class','btn btn-primary');
					$('#jieshou').text('是');
				}else{
					layer.alert('打开失败')
				}
			});
		}
	});


});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>