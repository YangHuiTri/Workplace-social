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
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/admin/static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="/admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>企业列表</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 企业管理 <span class="c-gray en">&gt;</span> 企业列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">

	<table class="table table-border table-bordered table-bg">
		<thead>
			<tr>
				<th scope="col" colspan="9">企业列表</th>
			</tr>
			<tr class="text-c">
				<th width="25"><input type="checkbox" name="" value=""></th>
				<th width="40">ID</th>
				<th width="150">企业名</th>
				<th width="90">电话</th>
				<th width="180">邮箱</th>
				<th width="50">员工数</th>
				<th width="180">简介</th>
				<th width="130">加入时间</th>
				<th width="100">操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $val)
			<tr class="text-c">
				<td><input type="checkbox" value="{{$val->id}}" name=""></td>
				<td>{{$val->id}}</td>
				<td>{{$val->com_name}}</td>
				<td>{{$val->mobile}}</td>
				<td>{{$val->email}}</td>
				<td>{{$val->emp_count}}</td>
				<td>{{$val->introduction}}</td>
				<td>{{ $val->created_at }}</td>
				<td class="td-manage">
					<a title="删除" href="javascript:;" onclick="admin_del(this,'<?php echo $val->id; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.min.js"></script> 
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.js"></script> <!--/_footer 作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/My97DatePicker/4.8/WdatePicker.js"></script> 
<script type="text/javascript" src="/admin/lib/datatables/1.10.0/jquery.dataTables.min.js"></script> 
<script type="text/javascript" src="/admin/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
//实例化datatables插件
$('table').dataTable({
	//禁用掉第一列的排序
	"aoColumnDefs" : [{"bSortable":false,"aTargets":[0]}],
	//默认在初始化的时候按照哪一列进行排序
	"aaSorting":[[1,"asc"]],
});


/*企业-删除*/
function admin_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.get('/admin/company/del',{'id':id},function(data){
			if(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			}
		});		
	});
}
</script>
</body>
</html>