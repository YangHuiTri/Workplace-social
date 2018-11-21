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
<!--[if lt IE 9]>
<script type="text/javascript" src="/admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" href="/home/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!-- 引入webuploader的需要css文件 -->
<link rel="stylesheet" type="text/css" href="/statics/webuploader-0.1.5/webuploader.css">
<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>编辑资料</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<article class="container page-container">
	<h1 style="margin-left: 230px;color: #0066CC">编辑资料</h1>
	<hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-left: 100px" /><br>
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				@if($type == 'company')
				<input type="text" class="input-text" value="" placeholder="{{Auth::guard('company')->user()->com_name}}" id="username" name="com_name">
				@elseif($type == 'member')
				<input type="text" class="input-text" value="" placeholder="{{Auth::guard('member')->user()->username}}" id="username" name="username">
				@endif
			</div>
		</div>

		@if($type == 'member')
			<div class="row cl">
	            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
	            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
	                <div class="radio-box">
	                    <input name="gender" type="radio" id="gender-1" value="1" checked>
	                    <label for="gender-1">男</label>
	                </div>
	                <div class="radio-box">
	                    <input type="radio" id="gender-2" name="gender" value="2">
	                    <label for="gender-2">女</label>
	                </div>
	                <div class="radio-box">
	                    <input type="radio" id="gender-3" name="gender" value="3">
	                    <label for="gender-3">保密</label>
	                </div>
	            </div>
	        </div>
		@endif

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="@if($type == 'company'){{Auth::guard('company')->user()->mobile}}@elseif($type == 'member'){{Auth::guard('member')->user()->mobile}}@endif" id="mobile" name="mobile">
			</div>
		</div>
		
		@if($type == 'company')
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>规模：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<input type="text" class="input-text" value="" placeholder="在职/在校人数" id="emp_count" name="emp_count">
				</div>
			</div>
		@endif

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3" style="color: gray">邮箱：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" disabled="disabled" placeholder="@if($type == 'company') {{Auth::guard('company')->user()->email}}                            @elseif($type == 'member') {{Auth::guard('member')->user()->email}}                          @endif
				" name="email" id="email">
			</div>
		</div>

		<div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">头像：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <!-- 给webuploader使用的div -->
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list">
                        <!-- 添加隐藏域 -->
                        <input type="hidden" name="avatar" value=""/>
                    </div>
                    <div id="filePicker">选择图片</div>
                </div>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>所属地区：</label>
            <div class="formControls col-xs-8 col-sm-9"> 
            	<span class="select-box" style="width:110px;">
				<select class="select" name="country_id" size="1">
					<option value="0">国家</option>
					@foreach($country as $val)
					<option value="{{$val -> id}}">{{$val -> area}}</option>
					@endforeach
				</select>
				</span>
				<span class="select-box" style="width:110px;">
				<select class="select" name="province_id" size="1">
					<option value="0">省份/州</option>
				</select>
				</span> 
				<span class="select-box" style="width:110px;">
				<select class="select" name="city_id" size="1">
					<option value="0">城市</option>
				</select>
				</span> 
				<span class="select-box" style="width:110px;">
				<select class="select" name="county_id" size="1">
					<option value="0">县区</option>
				</select>
				</span> 
			</div>
        </div>

		@if($type == 'member')
	        <div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>学历：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="select-box" style="width:110px;">
					<select class="select" name="education" size="1">
						<option value="">请选择</option>
						<option value="1">高中</option>
						<option value="2">大专</option>
						<option value="3">本科</option>
						<option value="4">硕士</option>
						<option value="5">博士</option>
						<option value="0">其他</option>
					</select>
				</div>
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>毕业院校：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="select-box" style="width:110px;">
						<select class="select" name="school_id" size="1">
							<option value="null">请选择</option>
							@foreach($data as $value)
								<option value="{{$value->id}}">{{$value->com_name}}</option>
							@endforeach
							<option value="0">其他</option>
						</select>
					</span>
				</div>			
			</div>

			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>就业公司：</label>
				<div class="formControls col-xs-8 col-sm-9">
					<span class="select-box" style="width:230px;">
					<select class="select" name="com_id" size="1">
						<option value="null">请选择</option>
						@foreach($data2 as $val)
							<option value="{{$val->id}}">{{$val->com_name}}</option>
						@endforeach
						<option value="0">其他</option>
					</select>
				</span>
				</div>			
			</div>
		@endif		

<!-- 		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>账号状态：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="radio-box">
					<input name="status" type="radio" id="status-1" value="1">
					<label for="status-1">禁用</label>
				</div>
				<div class="radio-box">
					<input type="radio" id="status-2" name="status" value="2" checked>
					<label for="status-2">启用</label>
				</div>
			</div>
		</div> -->

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>简介：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="introduction" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="$.Huitextarealength(this,100)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>
		{{ csrf_field() }}
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script src="/home/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="/admin/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<!-- 引入webuploader的JavaScript文件 -->
<script type="text/javascript" src="/statics/webuploader-0.1.5/webuploader.js"></script>
<script type="text/javascript" src="/statics/avatar.js"></script>
<script type="text/javascript">
$(function(){




	//在选择国家之后列出省份的数据
	$('select[name=country_id]').change(function(){
		//获取当前国家id
		var id = $(this).val();
		$.get('/home/edit/getareabyid',{id:id},function(data){
			//jQuery的循环操作
			var str = '';
			$.each(data,function(index,el){
				str += "<option value='" + el.id + "'>" + el.area + "</option>";
			});
			//在追加之前先清除之前的二级下的数据
			$('select[name=province_id]').find('option:gt(0)').remove();
			$('select[name=city_id]').find('option:gt(0)').remove();
			$('select[name=county_id]').find('option:gt(0)').remove();
			//将数据放到对应的option之后
			$('select[name=province_id]').append(str);
		},'json');
	});

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

    	//在选择城市之后列出省份的数据
    	$('select[name=city_id]').change(function(){
    		//获取当前城市id
    		var id = $(this).val();
    		$.get('/home/edit/getareabyid',{id: id},function(data){
    			//jQuery的循环操作
    			var str = '';
    			$.each(data,function(index,el){
    				str += "<option value='" + el.id + "'>" + el.area + "</option>";
    			});
    			//在追加之前先清除之前的二级下的数据
    			$('select[name=county_id]').find('option:gt(0)').remove();
    			//将数据放到对应的option之后
    			$('select[name=county_id]').append(str);
    		},'json');
    	});	

		//jQuery控制“控制器”和“方法名”表单项的动态显示和隐藏
		$('select[name=school_id]').parents('.row').hide();
    	//选择学历
    	$('select[name=education]').change(function(){
    		//获取当前学历id
    		var id = $(this).val();
    		if(id >= 3){
    			//显示选择毕业院校
				$('select[name=school_id]').parents('.row').show(300);
    		}else{
    			//隐藏
		 		//重置表单项里的值
    			$('select[name=school_id]').val('');
    			$('select[name=school_id]').parents('.row').hide(300);
    		}
    	});





	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-member-add").validate({
		rules:{
			username:{
				required:true,
				minlength:2,
				maxlength:20
			},
			com_name:{
				required:true,
				minlength:2,
				maxlength:20
			},
			gender:{
				required:true,
			},
			mobile:{
				required:true,
				isMobile:true,
			},
			email:{
				required:true,
				email:true,
			},
			introduction:{
				required:true,
				minlength:10,
				maxlength:200,
			},
			emp_count:{
				required:true,
			}

			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
            $(form).ajaxSubmit({
                type: 'post',
                url: "",//自己提交给自己可以不写url
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
});
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>