/**
 * 百度地图API功能
 */
    //创建Map实例
var map = new BMap.Map('allmap');
function bmap() {
//<c:if test='${empty awardInfo.baiduMapLng}'>
//	map.centerAndZoom('哈尔滨市', 12);
//</c:if>
//<c:if test='${not empty awardInfo.baiduMapLng}'>
//	var point = new BMap.Point(${awardInfo.baiduMapLng}, ${awardInfo.baiduMapLat});
//	map.centerAndZoom(point, 18);
//	var marker = new BMap.Marker(point);
//	map.addOverlay(marker);
//	marker.enableDragging();
//	marker.addEventListener('dragend', function(e){
//		document.getElementById('lnglat').innerHTML = '当前坐标：' + e.point.lng + ", " + e.point.lat;
//	});
//</c:if>
//上面使用的是JSP中的C标签,适用于需要读取数据库中储存的坐标,然后将位置信息显示在地图中,并添加可拖拽标注
//var point = new BMap.Point(116.404, 39.915); //创建点坐标
//map.centerAndZoom(point, 15);                //初始化地图(设置中心点坐标和地图缩放级别)
//    map.centerAndZoom("武汉市", 12);              //初始化地图(设置城市名和地图缩放级别)
    var point = new BMap.Point();
    map.centerAndZoom(point, 12); // 中心点
    map.addControl(new BMap.NavigationControl());  //添加平移缩放控件
    map.addControl(new BMap.ScaleControl());       //添加比例尺控件
    map.addControl(new BMap.OverviewMapControl()); //添加缩略地图控件
    map.enableScrollWheelZoom();                   //启用滚轮放大缩小
//map.disableDragging();                       //禁止地图拖拽
//map.enableDragging();                        //允许地图拖拽(默认为允许)


    /**
     * 浏览器定位(状态码说明如下)
     * BMAP_STATUS_SUCCESS            : 检索成功,对应数值"0"
     * BMAP_STATUS_CITY_LIST          : 城市列表,对应数值"1"
     * BMAP_STATUS_UNKNOWN_LOCATION   : 位置结果未知,对应数值"2"
     * BMAP_STATUS_UNKNOWN_ROUTE      : 导航结果未知,对应数值"3"
     * BMAP_STATUS_INVALID_KEY        : 非法密钥,对应数值"4"
     * BMAP_STATUS_INVALID_REQUEST    : 非法请求,对应数值"5"
     * BMAP_STATUS_PERMISSION_DENIED  : 没有权限,对应数值"6"(自1.1新增)
     * BMAP_STATUS_SERVICE_UNAVAILABLE: 服务不可用,对应数值"7"(自1.1新增)
     * BMAP_STATUS_TIMEOUT            : 超时,对应数值"8"(自1.1新增)
     */
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function (r) {
        console.log('浏览器定位的状态码为：' + this.getStatus());
        if (this.getStatus() == BMAP_STATUS_SUCCESS) {
            var mk = new BMap.Marker(r.point);
            map.addOverlay(mk);
            map.panTo(r.point);
            // document.getElementById('lnglat').value =r.point.lng + "," + r.point.lat;

            //创建地址解析器实例
            var myGeo = new BMap.Geocoder();
            //实时获取地址
            myGeo.getLocation(r.point, function (rs) {
                var addComp = rs.addressComponents;
                var address = addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber;
                showMap(address);
            });
        } else {
            //switch(this.getStatus()){
            //	case 6 : document.getElementById('lnglat').innerHTML = '请求未授权,无法提供定位服务'; break;
            //	default: document.getElementById('lnglat').innerHTML = '无法获取当前位置,您可移动地图查看'; break;
            //}
            new BMap.LocalCity().get(function (result) {
                console.log('IP定位获取当前城市：' + result.name);
                map.setCenter(result.name);
            });
        }
    }, {enableHighAccuracy: true});

}