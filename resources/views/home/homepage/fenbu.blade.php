<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>员工分布图</title>
</head>
<body>
	<div id="map" style="width:800px;height: 500px;"></div>
<script src="/home/js/highmaps.js"></script>
<script src="/home/js/china.js"></script>
<script>
// 随机数据
// var data = [{"name":"天津","value":92},{"name":"河北","value":4},{"name":"山西","value":38},{"name":"内蒙古","value":51},{"name":"辽宁","value":92},{"name":"吉林","value":95},{"name":"黑龙江","value":88},{"name":"上海","value":47},{"name":"江苏","value":84},{"name":"浙江","value":20},{"name":"安徽","value":4},{"name":"福建","value":75},{"name":"江西","value":25},{"name":"山东","value":2},{"name":"河南","value":64},{"name":"湖北","value":10},{"name":"湖南","value":12},{"name":"广东","value":29},{"name":"广西","value":5},{"name":"海南","value":57},{"name":"重庆","value":88},{"name":"四川","value":41},{"name":"贵州","value":80},{"name":"云南","value":65},{"name":"西藏","value":25},{"name":"陕西","value":49},{"name":"甘肃","value":30},{"name":"青海","value":2},{"name":"宁夏","value":96},{"name":"新疆","value":4},{"name":"台湾","value":22},{"name":"香港","value":18},{"name":"澳门","value":30},{"name":"南海诸岛","value":57},{"name":"南海诸岛","value":4}];
var data = {!!$str!!};
// 初始化图表2850920138
var map = new Highcharts.Map('map', {
  title: {
    text: '职员地区分布图'
  },
  colorAxis: {
    min: 0,
    minColor: 'rgb(255,255,255)',
    maxColor: '#006cee'
  },
  series: [{
    data: data,
    name: '',
    mapData: Highcharts.maps['cn/china'],
    joinBy: 'name' // 根据 name 属性进行关联
  }]
});
</script></body></html>