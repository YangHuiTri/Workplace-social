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

<title>发布招聘信息</title>
<meta name="keywords" content="">
<meta name="description" content="">
</head>
<body>
<article class="container page-container">
	<h1 style="margin-left: 230px;color: #0066CC">发布招聘信息</h1>
	<hr style="height:1px;border:none;border-top:1px dashed #0066CC;margin-left: 100px" /><br>
	<form action="" method="post" class="form form-horizontal" id="form-member-add">
		
		<div class="row cl">
			<label for="recruit_title" class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>招聘职位：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 530px;">
				<input type="text" id="recruit_title" name="recruit_title" class="input-text" placeholder="">
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
			<label for="work_experience" class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>工作经验：</label>
			<div class="formControls col-xs-8 col-sm-9" style="width: 140px;">
				<!-- <input type="text" id="work_experience" name="work_experience" class="input-text" placeholder="年"> -->
				<span class="select-box" id="work_experience" style="width:110px;">
						<select class="select" name="work_experience" size="1">
							<option value="null">请选择</option>
							<option value="0">无</option>
							<option value="1">1年</option>
							<option value="2">2年</option>
							<option value="3">3年</option>
							<option value="4">4年</option>
							<option value="5">5年</option>
							<option value="6">5年以上</option>
						</select>
					</span>
			</div>
		</div>

		<div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>工作城市：</label>
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
			<label for="content" class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>职位描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea style="height: 240px;width: 500px;" name="content" class="form-control" id="content" wrap="physical"></textarea>
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
			recruit_title:{
				required:true,
			},
			recruit_type:{
				required:true,
			},
			category_id:{
				required:true,
			},
			education:{
				required:true,
			},
			work_experience:{
				required:true,
			},
			content:{
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
                    if(data == '1'){
                    	layer.msg('发布成功!', { icon: 1, time: 2000 },function(){
                        	var index = parent.layer.getFrameIndex(window.name);
			                // parent.$('.btn-refresh').click();
			                window.location.href="/";
			                // 刷新
			                // parent.window.location = parent.window.location;
			                parent.layer.close(index);
                        });
                    }else{
                    	layer.msg('发布失败!', { icon: 2, time: 2000 });
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