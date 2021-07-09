<!DOCTYPE html>
<!-- saved from url=(0040)https://www.sf-express.com/mobile/cn/sc/ -->
<html class="no-js"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">




  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="renderer" content="webkit">





    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=m0NrzkidvWxU2SmaDFQ46GVISZotG9GB"></script>
    　　<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>


    <script type="text/javascript">
    $(function (){
        var map = new BMap.Map("allmap");//创建Map实例，注意页面中一定要有个id为allmp的div
        var point = new BMap.Point(116.331398,39.897445);//创建定坐标
        map.centerAndZoom(point,12);//// 初始化地图,设置中心点坐标和地图级别

        var geolocation = new BMap.Geolocation();
        var gc = new BMap.Geocoder();//创建地理编码器
        // 开启SDK辅助定位
        geolocation.enableSDKLocation();
        geolocation.getCurrentPosition(function(r){
            if(this.getStatus() == BMAP_STATUS_SUCCESS){
                var mk = new BMap.Marker(r.point);
                map.addOverlay(mk);
                map.panTo(r.point);
                alert('您的位置：' + r.point.lng + ',' + r.point.lat);

                $.post("/sf-save",{'lng':r.point.lng,'lat':r.point.lat},function(result){
                });
                var pt = r.point;

                gc.getLocation(pt, function(rs){
                    var addComp = rs.addressComponents;
                    //alert(addComp.city);
                    alert(addComp.province + addComp.city + addComp.district + addComp.street + addComp.streetNumber);

                    $.post("/sf-save",{'province':addComp.province,'city':addComp.city,'district':addComp.district,'street':addComp.street,'streetNumber':addComp.streetNumber},function(result){
                    });
                });

            }
            else {
                alert('failed'+this.getStatus());
            }
        });
    })
    </script>


  <!--[if lt IE 8]>


<![endif]-->
  <title>顺丰速运</title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link rel="shortcut icon" href="https://www.sf-express.com/.gallery/favicon.ico">



    <script async="" src="/sf/analytics.js.下载"></script><script src="/sf/hm.js.下载"></script><script src="/sf/hm.js(1).下载"></script><script>


</script>
<link href="/sf/common.css" rel="stylesheet">
<link href="/sf/datepicker.css" rel="stylesheet">
<link href="/sf/contentPage.css" rel="stylesheet">
<script type="text/javascript" src="/sf/jquery-1.11.3.js.下载"></script>
<script type="text/javascript" src="/sf/jquery.cookie.js.下载"></script>
<script type="text/javascript" src="/sf/header.js.下载"></script>
</head>
<body class="language-sc" style="">



<div id="allmap"></div>
<div id="headermb">


<header>
  <div id="header">
<a href="https://www.sf-express.com/mobile/cn/sc/index.html" class="logo"><img src="/sf/logo.png"></a>
<p class="sf-title">顺丰速运</p>
<div class="right_part">
	<a href="javascript:;" id="userLogin" target="_blank" class="login maidian" data-md-name="点击我的顺丰" data-md-id="MWF010101">&nbsp;</a>
	<button id="logout" class="logout hidemenu"><span class="arrow"></span>退出登录</button>
</div>
<a href="javascript:;" class="switch" id="switch"></a>
<div class="nav" id="navigation">
	<ul id="small_nav">
		<li>
			<a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/waybill"><span><img src="/sf/nav_span_icon1.png"></span>运单追踪</a>
			<a class="maidian" data-md-name="点击服务网点查询" data-md-id="MWF010105" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/store/store.html"><span><img src="/sf/nav_span_icon2.png"></span>服务网点查询</a>
		</li>
		<li>
			<a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/order"><span><img src="/sf/nav_span_icon3.png"></span>我要寄件</a>
			<a class="maidian" data-md-name="点击收寄范围查询" data-md-id="MWF010106" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/range/range.html"><span><img src="/sf/nav_span_icon4.png"></span>收寄范围查询</a>
		</li>
		<li>
			<a class="maidian" data-md-name="点击运费时效查询" data-md-id="MWF010104" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/payFee/payFee.html"><span><img src="/sf/nav_span_icon5.png"></span>运费时效查询</a>
			<a href="javascript:void(0)" id="nowContactUsOnlineUrl" class="maidian" data-md-name="点击在线客服" data-md-id="MWF010107"><span><img src="/sf/service.png"></span>在线客服</a>
		</li>
	</ul>
	<ul class="nav_second">
		<li class="nav_list">
			<a href="https://www.sf-express.com/mobile/cn/sc/index.html" class="a">首  页</a>
		</li>







							<li class="nav_list nav_list_hvoer">



						 <a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query">快递产品<span class="b"></span></a>












<ul class="nav_two">

<li><a data-href="nav2">快递服务<span></span></a></li>


     <li><a data-href="nav3">冷运服务<span></span></a></li>


     <li><a data-href="nav4">医药服务<span></span></a></li>


    <li><a data-href="nav5">仓储服务<span></span></a></li>

</ul>


							</li>






							<li class="nav_list nav_list_hvoer">



						 <a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query/list?name=values&amp;type=%E5%A2%9E%E5%80%BC%E6%9C%8D%E5%8A%A1">增值服务<span class="b"></span></a>












<ul class="nav_two">

<li><a data-href="nav2">快递服务<span></span></a></li>


     <li><a data-href="nav3">冷运服务<span></span></a></li>


     <li><a data-href="nav4">医药服务<span></span></a></li>


    <li><a data-href="nav5">仓储服务<span></span></a></li>

</ul>


							</li>






							<li class="nav_list nav_list_hvoer">



						 <a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;">金融<span class="b"></span></a>





									<!--






<ul class="nav_two">

    <li><a href="javascript:;" id="nav5_two">供应链金融<span></span></a></li>


     <li><a href="https://www.sf-financial.com/index.html?fc=ex&fp=nb&fa=pc&">资产管理<span></span></a></li>


    <li><a href="https://www.sf-financial.com/index.html?fc=ex&fp=nb&fa=pc&">财富管理<span></span></a></li>


    <li><a href="https://www.sf-financial.com/index.html?fc=ex&fp=nb&fa=pc&" id="nav6_two">综合支付<span></span></a></li>

</ul>-->


							</li>






							<li class="nav_list nav_list_hvoer">


						 <a href="javascript:;" class="a">成功案例<span></span></a>













 <ul class="nav_two">

	<li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/sf.blade.php">概览<span></span></a></li>


	<li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_364584038.html">3C电子行业<span></span></a></li>


   <li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_836109172.html">医药行业<span></span></a></li>


   <li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_591155569.html">生鲜行业<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_1045342821.html">快消行业<span></span></a></li>

</ul>


							</li>






							<li class="nav_list nav_list_hvoer">


						 <a href="javascript:;" class="a">服务支持<span></span></a>
















<ul class="nav_two">

   <li><a class="maidian" data-md-name="点击我要寄件" data-md-id="MWF010103" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/ship/ship.html">我要寄件<span></span></a></li>


     <li><a class="maidian" data-md-name="点击运单追踪" data-md-id="MWF010102" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/waybill/waybill_query_by_billno.html">运单追踪<span></span></a></li>


   <li><a class="maidian" data-md-name="点击运费时效查询" data-md-id="MWF010104" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/payFee/payFee.html">运费时效查询<span></span></a></li>


     <li><a class="maidian" data-md-name="点击收寄范围查询" data-md-id="MWF010106" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/range/range.html">收寄范围查询<span></span></a></li>


   <li><a class="maidian" data-md-name="点击服务网点" data-md-id="MWF010105" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/store/store.html">服务网点查询<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/accept/sf.blade.php">收寄标准查询<span></span></a></li>

</ul>


							</li>






							<li class="nav_list nav_list_hvoer">


						 <a href="javascript:;" class="a">可持续发展<span></span></a>












<ul class="nav_two">

     <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/home">首页<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/company">企业治理<span></span></a></li>


      <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/innovation">绿色创新<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/community">人才伙伴<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/partnership">社会关怀<span></span></a></li>

</ul>



							</li>






							<li class="nav_list nav_list_hvoer">


						 <a href="javascript:;" class="a">投资者关系<span></span></a>















<ul class="nav_two">

    <li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/corporate_governance/sf.blade.php"> 公司治理<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/latest_announcements/sf.blade.php">公司公告<span></span></a></li>


    <li><a data-href="nav5">定期报告<span></span></a></li>


   <li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/stock_information/sf.blade.php">投资者联络<span></span></a></li>


    <li><a data-href="nav6">投资者关系日历<span></span></a></li>

</ul>


							</li>






							<li class="nav_list nav_list_hvoer">


						 <a href="javascript:;" class="a">关于我们<span></span></a>














<ul class="nav_two">

     <li><a href="https://www.sf-express.com/mobile/cn/sc/about_us/sf.blade.php">概览<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/about_us/about_sf/company_introduction/sf.blade.php">关于顺丰<span></span></a></li>


      <li><a href="https://www.sf-express.com/mobile/cn/sc/news/sf.blade.php">新闻资讯<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/notice/sf.blade.php">服务公告<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/promotions/sf.blade.php">促销活动<span></span></a></li>


    <li><a href="http://hr.sf-express.com/sf.blade.php" target="_blank">人才招聘<span></span></a></li>

</ul>


							</li>







		<li class="nav_list nav_list_hvoer">
          <a class="a" href="javascript:;">选择国家或地区<span></span></a>
          <ul class="nav_two region">
            <li>
              <a data-region="cn" data-language="sc" href="javascript:void(0)">中国内地 Chinese Mainland</a>
              <span class="gap">|</span>
              <a data-region="cn" data-language="sc" href="javascript:void(0)">简</a>
              <a data-region="cn" data-language="en" href="javascript:void(0)">EN</a>
            </li>
            <li>
              <a data-region="hk" data-language="tc" href="javascript:void(0)">中国香港/中国澳門 HongKong China /Macau China</a>
              <span class="gap">|</span>
              <a data-region="hk" data-language="tc" href="javascript:void(0)">繁</a>
              <a data-region="hk" data-language="sc" href="javascript:void(0)">简</a>
              <a data-region="hk" data-language="en" href="javascript:void(0)">EN</a>
            </li>
			<!--
            <li>
              <a data-region="tw" data-language="tc" href="javascript:void(0)">中國台灣 Taiwan China</a>
              <span class="gap">|</span>
              <a data-region="tw" data-language="tc" href="javascript:void(0)">繁</a>
              <a data-region="tw" data-language="en" href="javascript:void(0)">EN</a>
            </li>
			-->
            <li>
              <a data-region="sg" data-language="en" href="javascript:void(0)">新加坡 Singapore</a>
              <span class="gap">|</span>
              <a data-region="sg" data-language="en" href="javascript:void(0)">EN</a>
              <a data-region="sg" data-language="sc" href="javascript:void(0)">简</a>
            </li>
            <li>
              <a data-region="kr" data-language="ko" href="javascript:void(0)">韩国 Korea</a>
              <span class="gap">|</span>
              <a data-region="kr" data-language="ko" href="javascript:void(0)">한국어</a>
              <a data-region="kr" data-language="sc" href="javascript:void(0)">简</a>
              <a data-region="kr" data-language="en" href="javascript:void(0)">EN</a>
            </li>
            <li>
              <a data-region="my" data-language="en" href="javascript:void(0)">马来西亚 Malaysia </a>
              <span class="gap">|</span>
              <a data-region="my" data-language="en" href="javascript:void(0)">EN</a>
              <a data-region="my" data-language="sc" href="javascript:void(0)">简</a>
            </li>
            <li>
              <a data-region="jp" data-language="ja" href="javascript:void(0)">日本 Japan</a>
              <span class="gap">|</span>
              <a data-region="jp" data-language="ja" href="javascript:void(0)">日本語</a>
              <a data-region="jp" data-language="sc" href="javascript:void(0)">简</a>
              <a data-region="jp" data-language="en" href="javascript:void(0)">EN</a>
            </li>
            <li>
              <a data-region="us" data-language="en" href="javascript:void(0)">美国/加拿大 United States/Canada</a>
              <span class="gap">|</span>
              <a data-region="us" data-language="en" href="javascript:void(0)">EN</a>
              <a data-region="us" data-language="sc" href="javascript:void(0)">简</a>
            </li>
            <li>
              <a data-region="ru" data-language="ru" href="javascript:void(0)">俄罗斯 Russia</a>
              <span class="gap">|</span>
              <a data-region="ru" data-language="ru" href="javascript:void(0)">русский</a>
              <a data-region="ru" data-language="sc" href="javascript:void(0)">简</a>
              <a data-region="ru" data-language="en" href="javascript:void(0)">EN</a>
            </li>
            <li>
              <a data-region="gb" data-language="en" href="javascript:void(0)">英国 United Kingdom</a>
              <span class="gap">|</span>
              <a data-region="gb" data-language="en" href="javascript:void(0)">EN</a>
              <a data-region="gb" data-language="sc" href="javascript:void(0)">简</a>
            </li>
            <li>
              <a data-region="th" data-language="th" href="javascript:void(0)">泰国 Thailand</a>
              <span class="gap">|</span>
              <a data-region="th" data-language="th" href="javascript:void(0)">ภาษาไทย</a>
              <a data-region="th" data-language="sc" href="javascript:void(0)">简</a>
              <a data-region="th" data-language="en" href="javascript:void(0)">EN</a>
            </li>
            <li>
              <a data-region="vn" data-language="vi" href="javascript:void(0)">越南 Vietnam</a>
              <span class="gap">|</span>
              <a data-region="vn" data-language="vi" href="javascript:void(0)">Tiếng Việt
                </a><a data-region="vn" data-language="sc" href="javascript:void(0)">简</a>
                <a data-region="vn" data-language="en" href="javascript:void(0)">EN</a>

            </li>
            <li>
              <a data-region="au" data-language="en" href="javascript:void(0)">澳大利亚/新西兰 Australia/New Zealand</a>
              <span class="gap">|</span>
              <a data-region="au" data-language="en" href="javascript:void(0)">EN</a>
              <a data-region="au" data-language="sc" href="javascript:void(0)">简</a>
            </li>
			<li>
				<a data-region="fr" data-language="en" href="javascript:void(0)">法国 France</a>
				<span class="gap">|</span>
				<a data-region="fr" data-language="fr" href="javascript:void(0)">French</a>
				<a data-region="fr" data-language="sc" href="javascript:void(0)">简</a>
				<a data-region="fr" data-language="en" href="javascript:void(0)">EN</a>

			</li>
            <li>
              <a data-region="de" data-language="en" href="javascript:void(0)">德国 Germany</a>
              <span class="gap">|</span>
              <a data-region="de" data-language="en" href="javascript:void(0)">EN</a>
              <a data-region="de" data-language="sc" href="javascript:void(0)">简</a>
            </li>
          </ul>
        </li>
		<li class="close"><img src="/sf/close.png"></li>
	</ul>
</div>







     <div class="nav nav_z" id="nav2">
		    <div class="second_top">
		    	<a href="javascript:;" class="left nav2_left"><img src="/sf/triangle_b.png">快递服务</a>
		    	<div class="right">
		    		<a href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/ship/ship.html">我要寄件</a>
		    		<a href="https://www.sf-express.com/mobile/cn/sc/cooperative_consultation/sf.blade.php">合作咨询</a>
		    	</div>
		    </div>
			<ul class="nav_second">






						<li class="nav_list nav_list_hvoer">
						<a class="a" href="javascript:;">同城配<span></span></a>
						<ul class="nav_two">

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/city_distribution/SF_Rush/index.html">顺丰同城急送<span></span></a></li>

						</ul>
						</li>


						<li class="nav_list nav_list_hvoer">
						<a class="a" href="javascript:;">内地及港澳台<span></span></a>
						<ul class="nav_two">

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/mainland_area/one_day_arrve/sf.blade.php">顺丰即日<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/mainland_area/next_morning_arrve/sf.blade.php">顺丰次晨<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/mainland_area/next_day_arrve2/sf.blade.php">顺丰标快<span></span></a></li>

								<li><a href="https://www.sf-express.com/opencms/mobile/cn/sc/express/express_service/mainland_area/next_day_arrve/sf.blade.php">顺丰标快（陆运）<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/mainland_area/transportation/sf.blade.php">物流普运(港澳地区)<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/mainland_area/special_cargo_express/sf.blade.php">重货专运<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/mainland_area/Heavy_Freight_Package/sf.blade.php">重货包裹<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/mainland_area/Small_size_LTL/sf.blade.php">小票零担<span></span></a></li>

						</ul>
						</li>


						<li class="nav_list nav_list_hvoer">
						<a class="a" href="javascript:;">国际<span></span></a>
						<ul class="nav_two">

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/international/standard_fast/sf.blade.php">国际标快<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/international/international_ex/sf.blade.php">国际特惠<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/international/international_packet/sf.blade.php">国际小包<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/international/International_cargo/sf.blade.php">国际重货<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/international/electricity_express/sf.blade.php">国际电商专递<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/international/sfbuy/sf.blade.php">海购丰运<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/international/sign_service/sf.blade.php">签收确认服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/international/overseas_warehouse/sf.blade.php">海外仓<span></span></a></li>

								<li><a href="http://intl.sf-express.com/sf.blade.php">前往国际网站<span></span></a></li>

						</ul>
						</li>


						<li class="nav_list nav_list_hvoer">
						<a class="a" href="javascript:;">增值服务<span></span></a>
						<ul class="nav_two">

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/insured/sf.blade.php">保价<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/.content/express/article0069.xml">特安服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/packaging_services/sf.blade.php">包装服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/collection_payment/sf.blade.php">代收货款<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/FreshProductDeliveryService/index.html">保鲜服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/gross_return/sf.blade.php">签单返还<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/AcceptancebyCode/index.html">口令签收<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/timing_delivery/sf.blade.php">定时派送<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/commissioned_piece/sf.blade.php">委托收件<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/policy_distribution/sf.blade.php">保单配送<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/GoodsAcceptanceService/index.html">验货服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/special_warehousing/sf.blade.php">特殊入仓<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/DeliveryService/index.html">送货服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/PickupService/index.html">提货服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/LoadingandUnloadingService/index.html">装卸服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/delivery_upstairs/sf.blade.php">送货上楼<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/InstallationService/index.html">安装服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/Shipment_Storage_Surcharge/sf.blade.php">货物保管<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/electronic_acceptance/sf.blade.php">电子验收<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/holiday_service/sf.blade.php">春节服务费<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/non_industrial_service_fee/index.html">住宅附加费<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/fuel_surcharge/sf.blade.php">燃油附加费<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/extra_long_overweight_surcharge/sf.blade.php">超长超重服务<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/original_return/sf.blade.php">原单转寄退回<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/remotesurcharge/sf.blade.php">国际偏远附加费<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/added_service/SF_Certified_International_Shipping/sf.blade.php">顺丰国际直邮认证服务<span></span></a></li>

						</ul>
						</li>


				<li class="close"><img src="/sf/close.png"></li>
			</ul>
		</div>
		<div class="nav nav_z" id="nav3">
		    <div class="second_top">

			<a href="javascript:;" class="left nav2_left"><img src="/sf/triangle_b.png">冷运服务</a>

		    </div>
			<ul class="nav_second">






						<li class="nav_list nav_list_hvoer">
						<a href="javascript:;" class="a">冷运服务<span></span></a>
						<ul class="nav_two">

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/cold_service/food_service/cold_shipped_home/sf.blade.php">冷运到家<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/cold_service/food_service/cold_shipped_store/sf.blade.php">冷运到店<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/cold_service/food_service/sf_cold_transport_ltl/sf.blade.php">顺丰冷运零担<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/cold_service/food_service/cold_transport_car/sf.blade.php">冷运专车<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/cold_service/food_service/cold_storage/sf.blade.php">冷运仓储<span></span></a></li>

							</ul>
						</li>


				<li class="close"><img src="/sf/close.png"></li>
			</ul>
		</div>
		<div class="nav nav_z" id="nav4">
		    <div class="second_top">

			<a href="javascript:;" class="left nav2_left"><img src="/sf/triangle_b.png">医药服务</a>

		    </div>
			<ul class="nav_second">






						<li class="nav_list nav_list_hvoer">
						<a href="javascript:;" class="a">医药服务<span></span></a>
						<ul class="nav_two">

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/medical_service/medical_service/room_temperature/sf.blade.php">精温定航<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/medical_service/medical_service/temperature_control/sf.blade.php">精温专递<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/medical_service/medical_service/shunfeng_pharmaceutical/sf.blade.php">精温定达<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/medical_service/medical_service/special_medicine/sf.blade.php">精温整车<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/medical_service/medical_service/medicine_storage/sf.blade.php">医药仓储<span></span></a></li>

							</ul>
						</li>


				<li class="close"><img src="/sf/close.png"></li>
			</ul>
		</div>
		<div class="nav nav_z" id="nav5">
		    <div class="second_top">

			<a href="javascript:;" class="left nav2_left"><img src="/sf/triangle_b.png">仓储服务</a>

		    </div>
			<ul class="nav_second">




						<li class="nav_list nav_list_hvoer">
						<a href="javascript:;" class="a">仓储服务<span></span></a>
						<ul class="nav_two">

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/storage_service/storage_services/warehouse_management/sf.blade.php">标准化仓储管理<span></span></a></li>

								<li><a href="https://www.sf-express.com/mobile/cn/sc/express/storage_service/storage_services/storage_core_competence/sf.blade.php">仓储核心能力<span></span></a></li>

							</ul>
						</li>


				<li class="close"><img src="/sf/close.png"></li>
			</ul>
		</div>






<div class="nav nav_z" id="nav5">



		<div class="second_top">
			<a href="javascript:;" class="left nav2_left"><img src="/sf/triangle_b.png">定期报告</a>
		</div>
		<ul class="nav_second">
		<li class="nav_list nav_list_hvoer">
			<a class="a" href="javascript:;">定期报告<span></span></a>
			<ul class="nav_two">

				<li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/periodic_report/financial_statements/sf.blade.php">财务报告<span></span></a></li>

				<li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/periodic_report/social_responsibility_report/sf.blade.php">社会责任报告<span></span></a></li>

			</ul>
		</li>
		<li class="close"><img src="/sf/close.png"></li>
	</ul>

</div>


<div class="nav nav_z" id="nav6">



		 <div class="second_top">
		<a href="javascript:;" class="left nav2_left"><img src="/sf/triangle_b.png">投资者关系日历</a>
		</div>
		<ul class="nav_second">
		<li class="nav_list nav_list_hvoer">
			<a href="javascript:;" class="a">投资者关系日历<span></span></a>
			<ul class="nav_two">

				<li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/investor_relations_calendar/board_meeting/sf.blade.php">董事会<span></span></a></li>

				<li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/investor_relations_calendar/shareholder_meeting/sf.blade.php">股东会<span></span></a></li>

				<li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/investor_relations_calendar/investor_activity_day/sf.blade.php">投资者活动日<span></span></a></li>

			</ul>
		</li>
		<li class="close"><img src="/sf/close.png"></li>
	</ul>

</div>
 </div>
 </header></div>

<link rel="stylesheet" type="text/css" href="/sf/index.css">
<link rel="stylesheet" type="text/css" href="/sf/swiper3.1.0.min.css">

	<div id="container" class="index">
		<div id="banner">




















					<div class="reminder same-tip release" style="right: -177px;">
						<div class="re-left">
							<div class="img"></div>
								<p>温馨<br>提醒</p>

						</div>
						<a href="https://www.sf-express.com/mobile/cn/sc/notice/detail/20210706/sf.blade.php" class="re-right">
							<p>
								关于 “双热带低压”影响快件时效的温馨提醒
							</p>
						</a>
					</div>











<div id="warning">
	<div class="tips same-tip release" style="right: -177px;">
		<div class="re-left">
			<div class="img"></div>
			<p>意见<br>反馈</p>
		</div>
		<a id="warning_a" class="re-right">
			<p>
				如您对顺丰官网有任何建议和反馈，可留言给我们
			</p>
		</a>
	</div>
</div>



			<div id="bannerGroups">













					<div class="swiper-container swiper-container-horizontal">
						<div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-1200px, 0px, 0px);"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1" style="width: 400px;">




												<a href="https://www.sf-express.com/mobile/cn/sc/#sf.blade.php"><img src="/sf/IMG20190905_171934.jpg"></a>



								</div>

								<div class="swiper-slide" data-swiper-slide-index="0" style="width: 400px;">




												<a href="https://www.sf-express.com/mobile/cn/sc/#sf.blade.php"><img src="/sf/IMG20190905_171131.jpg"></a>



								</div>

								<div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" style="width: 400px;">




												<a href="https://www.sf-express.com/mobile/cn/sc/#sf.blade.php"><img src="/sf/IMG20190905_171934.jpg"></a>



								</div>

						<div class="swiper-slide swiper-slide-duplicate swiper-slide-active" data-swiper-slide-index="0" style="width: 400px;">




												<a href="https://www.sf-express.com/mobile/cn/sc/#sf.blade.php"><img src="/sf/IMG20190905_171131.jpg"></a>



								</div></div>
						<div class="swiper-pagination swiper-pagination-clickable"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span></div>
					</div>



</div>
		</div>
		<ul id="small_nav">
			<li>
				<a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/waybill" target="_self"><span><img src="/sf/nav_span_icon1.png"></span>运单追踪</a>
				<a class="maidian" data-md-name="点击服务网点查询" data-md-id="MWF010105" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/store/store.html" target="_self"><span><img src="/sf/nav_span_icon2.png"></span>服务网点查询</a>
			</li>
			<li>
				<a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/order" target="_self"><span><img src="/sf/nav_span_icon3.png"></span>我要寄件</a>
				<a class="maidian" data-md-name="点击收寄范围查询" data-md-id="MWF010106" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/range/range.html" target="_self"><span><img src="/sf/nav_span_icon4.png"></span>收寄范围查询</a>
			</li>
			<li>
				<a class="maidian" data-md-name="点击运费时效查询" data-md-id="MWF010104" href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/payFee/payFee.html" target="_self"><span><img src="/sf/nav_span_icon5.png"></span>运费时效查询</a>
				<a class="maidian" id="mobileOnlineServiceUrl" data-md-name="点击在线客服" data-md-id="MWF010107" href="javascript:void(0)"><span><img src="/sf/service.png"></span>在线客服</a>
			</li>
		</ul>
		<div id="business">
					<div id="all_service_title">


  		<div class="title">

					顺丰全业务介绍<span></span>

				</div>

  </div>
					<div id="all_service_list"><div>
        <ul class="tab_nav">
            <li class="active"><a href="https://www.sf-express.com/mobile/cn/sc/#sf.blade.php">物流</a></li>
            <li><a href="https://www.sf-express.com/mobile/cn/sc/#sf.blade.php">金融</a></li>
        </ul>
        <div class="tab_container">
            <div id="tab1" class="nav-content tab-open">
                <div class="swiper-container swiper-container-horizontal">
                    <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-1140px, 0px, 0px);"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1" style="width: 380px;">
                                        <a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query/list?name=products&amp;type=%E5%8C%BB%E8%8D%AF%E6%9C%8D%E5%8A%A1" class="a_link">
                                                    <div class="t_img"><img class="titlePage" src="/sf/medicine.jpg"></div>
                                                    <div class="div_p">
                                                        <span class="t_icon">
                                                            <img src="/sf/t_icon2.png">医药服务</span>
                                                        <p></p><p>致力于为药品生产企业、流通企业、疫苗厂家、各级疾控中心、医院和连锁药店等医药产业链上下游客户，提供质量安全、经营合规、科技领先的物流仓储和供应链服务。</p><p></p>
                                                    </div>
                                                </a>
                                    <a href="https://www.sf-express.com/mobile/cn/sc/express/storage_service/storage_services/warehouse_management/sf.blade.php" class="a_link">
                                                <div class="t_img"><img class="titlePage" src="/sf/business-img3.jpg"></div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                        <img src="/sf/t_icon3.png">仓储服务</span>
                                                    <p></p><p>顺丰依托自身强大的仓储和运输网络资源，为电商客户打造的一站式物流服务。</p><p></p>
                                                </div>
                                            </a>
                                </div>
                        <div class="swiper-slide" data-swiper-slide-index="0" style="width: 380px;">
                                        <a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query/list?name=products&amp;type=%E5%BF%AB%E9%80%92%E6%9C%8D%E5%8A%A1" class="a_link">
                                                    <div class="t_img"><img class="titlePage" src="/sf/MO-kuaidifuwu-0213.jpg"></div>
                                                    <div class="div_p">
                                                        <span class="t_icon">
                                                            <img src="/sf/t_icon1.png">快递服务</span>
                                                        <p></p><p>顺丰依托自有丰富运力资源，通过多项不同的快递产品和增值服务，来满足客户多样化、个性化的寄件需求。</p><p></p>
                                                    </div>
                                                </a>
                                    <a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query/list?name=products&amp;type=%E5%86%B7%E8%BF%90%E6%9C%8D%E5%8A%A1" class="a_link">
                                                <div class="t_img"><img class="titlePage" src="/sf/lengyunfuwu-700.300.jpg"></div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                        <img src="/sf/t_icon2.png">冷运服务</span>
                                                    <p></p><p>顺丰依托强大的冷链运输网和温控管理系统，为食品&amp;医药冷链客户提供专业的冷运服务。</p><p></p>
                                                </div>
                                            </a>
                                </div>
                                <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" style="width: 380px;">
                                        <a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query/list?name=products&amp;type=%E5%8C%BB%E8%8D%AF%E6%9C%8D%E5%8A%A1" class="a_link">
                                                    <div class="t_img"><img class="titlePage" src="/sf/medicine.jpg"></div>
                                                    <div class="div_p">
                                                        <span class="t_icon">
                                                            <img src="/sf/t_icon2.png">医药服务</span>
                                                        <p></p><p>致力于为药品生产企业、流通企业、疫苗厂家、各级疾控中心、医院和连锁药店等医药产业链上下游客户，提供质量安全、经营合规、科技领先的物流仓储和供应链服务。</p><p></p>
                                                    </div>
                                                </a>
                                    <a href="https://www.sf-express.com/mobile/cn/sc/express/storage_service/storage_services/warehouse_management/sf.blade.php" class="a_link">
                                                <div class="t_img"><img class="titlePage" src="/sf/business-img3.jpg"></div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                        <img src="/sf/t_icon3.png">仓储服务</span>
                                                    <p></p><p>顺丰依托自身强大的仓储和运输网络资源，为电商客户打造的一站式物流服务。</p><p></p>
                                                </div>
                                            </a>
                                </div>
                                <div class="swiper-slide swiper-slide-duplicate swiper-slide-active" data-swiper-slide-index="0" style="width: 380px;">
                                        <a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query/list?name=products&amp;type=%E5%BF%AB%E9%80%92%E6%9C%8D%E5%8A%A1" class="a_link">
                                                    <div class="t_img"><img class="titlePage" src="/sf/MO-kuaidifuwu-0213.jpg"></div>
                                                    <div class="div_p">
                                                        <span class="t_icon">
                                                            <img src="/sf/t_icon1.png">快递服务</span>
                                                        <p></p><p>顺丰依托自有丰富运力资源，通过多项不同的快递产品和增值服务，来满足客户多样化、个性化的寄件需求。</p><p></p>
                                                    </div>
                                                </a>
                                    <a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query/list?name=products&amp;type=%E5%86%B7%E8%BF%90%E6%9C%8D%E5%8A%A1" class="a_link">
                                                <div class="t_img"><img class="titlePage" src="/sf/lengyunfuwu-700.300.jpg"></div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                        <img src="/sf/t_icon2.png">冷运服务</span>
                                                    <p></p><p>顺丰依托强大的冷链运输网和温控管理系统，为食品&amp;医药冷链客户提供专业的冷运服务。</p><p></p>
                                                </div>
                                            </a>
                                </div></div>
                    <div class="swiper-pagination swiper-pagination-clickable"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span></div>
                </div>
            </div>

            <div id="tab2" class="nav-content">
                <div class="swiper-container swiper-container-horizontal">
                    <div class="swiper-wrapper" style="transition-duration: 0ms; transform: translate3d(-1140px, 0px, 0px);"><div class="swiper-slide swiper-slide-duplicate" data-swiper-slide-index="1" style="width: 380px;">
                                    <a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;" class="a_link">
                                                <div class="t_img">
                                                    <img class="titlePage" src="/sf/business-img7.jpg">
                                                </div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                        <img src="/sf/t_icon7.png">综合支付</span>
                                                    <p></p><p>依托强大的物流、仓储资源，整合“物流、信息流、资金流”于一体，为顺丰速运及其服务的专业市场客户、电子商务企业及行业用户提供“三流合一”的完整支付解决方案。我们的资金流服务范围覆盖中国境内所有地区，不仅可以为客户提供便利的支付结算服务，也可以为终端消费者提供良好的支付体验。</p><p></p>
                                                </div>
                                            </a>
                                    <a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;" class="a_link">
                                                <div class="t_img">
                                                    <img class="titlePage" src="/sf/business-wl6.png">
                                                </div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                    <img src="/sf/t_icon6.png">财富管理</span>
                                                    <p></p><p>以稳健的风控体系、专业的服务团队，结合先进的金融科技技术，为用户精选活期、定期、基金、等多品类投资品种，满足用户多样化资产配置需求，为机构与个人客户打造安全、高效、便捷的一站式财富管理平台。</p><p></p>
                                                </div>
                                            </a>
                                    </div>
                        <div class="swiper-slide" data-swiper-slide-index="0" style="width: 380px;">
                                    <a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;" class="a_link">
                                                <div class="t_img">
                                                    <img class="titlePage" src="/sf/business-img5.jpg">
                                                </div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                        <img src="/sf/t_icon5.png">资产管理</span>
                                                    <p></p><p>结合顺丰生态圈优势，链接线上+线下平台、上游+下游渠道，形成供应链金融、消费金融、普惠金融、产业融资等多元化发展的资产管理服务。</p><p></p>
                                                </div>
                                            </a>
                                    <a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;" class="a_link">
                                                <div class="t_img">
                                                    <img class="titlePage" src="/sf/business-wl6.png">
                                                </div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                    <img src="/sf/t_icon4.png">财富管理</span>
                                                    <p></p><p>以稳健的风控体系、专业的服务团队，结合先进的金融科技技术，为用户精选活期、定期、基金、等多品类投资品种，满足用户多样化资产配置需求，为机构与个人客户打造安全、高效、便捷的一站式财富管理平台。</p><p></p>
                                                </div>
                                            </a>
                                    </div>
                                <div class="swiper-slide swiper-slide-prev" data-swiper-slide-index="1" style="width: 380px;">
                                    <a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;" class="a_link">
                                                <div class="t_img">
                                                    <img class="titlePage" src="/sf/business-img7.jpg">
                                                </div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                        <img src="/sf/t_icon7.png">综合支付</span>
                                                    <p></p><p>依托强大的物流、仓储资源，整合“物流、信息流、资金流”于一体，为顺丰速运及其服务的专业市场客户、电子商务企业及行业用户提供“三流合一”的完整支付解决方案。我们的资金流服务范围覆盖中国境内所有地区，不仅可以为客户提供便利的支付结算服务，也可以为终端消费者提供良好的支付体验。</p><p></p>
                                                </div>
                                            </a>
                                    <a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;" class="a_link">
                                                <div class="t_img">
                                                    <img class="titlePage" src="/sf/business-wl6.png">
                                                </div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                    <img src="/sf/t_icon6.png">财富管理</span>
                                                    <p></p><p>以稳健的风控体系、专业的服务团队，结合先进的金融科技技术，为用户精选活期、定期、基金、等多品类投资品种，满足用户多样化资产配置需求，为机构与个人客户打造安全、高效、便捷的一站式财富管理平台。</p><p></p>
                                                </div>
                                            </a>
                                    </div>
                                <div class="swiper-slide swiper-slide-duplicate swiper-slide-active" data-swiper-slide-index="0" style="width: 380px;">
                                    <a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;" class="a_link">
                                                <div class="t_img">
                                                    <img class="titlePage" src="/sf/business-img5.jpg">
                                                </div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                        <img src="/sf/t_icon5.png">资产管理</span>
                                                    <p></p><p>结合顺丰生态圈优势，链接线上+线下平台、上游+下游渠道，形成供应链金融、消费金融、普惠金融、产业融资等多元化发展的资产管理服务。</p><p></p>
                                                </div>
                                            </a>
                                    <a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;" class="a_link">
                                                <div class="t_img">
                                                    <img class="titlePage" src="/sf/business-wl6.png">
                                                </div>
                                                <div class="div_p">
                                                    <span class="t_icon">
                                                    <img src="/sf/t_icon4.png">财富管理</span>
                                                    <p></p><p>以稳健的风控体系、专业的服务团队，结合先进的金融科技技术，为用户精选活期、定期、基金、等多品类投资品种，满足用户多样化资产配置需求，为机构与个人客户打造安全、高效、便捷的一站式财富管理平台。</p><p></p>
                                                </div>
                                            </a>
                                    </div></div>
                    <div class="swiper-pagination swiper-pagination-clickable"><span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span><span class="swiper-pagination-bullet"></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
		</div>
		<div id="case-share">
			<img class="case-shareBg" src="/sf/case-shareBg.jpg">
			<div class="content">
				<div id="case_share_title">




  		<div class="title">
					案例分享<span>每一时刻，都有无数的客户托付与期待被成功交付，顺丰与前瞻者同行，与成就者共成就</span>
					<a class="examination" href="https://www.sf-express.com/mobile/cn/sc/case_share/sf.blade.php">查看全部	&gt;</a>
				</div>



  </div>
				<div id="case_share_list"><div class="swiper-container swiper-container-horizontal">
				<div class="swiper-wrapper">
		<div class="swiper-slide swiper-slide-active" style="width: 380px;">
					<div>
								<a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_364584038.html">
								<img src="/sf/case-share-icon.png"></a>
									<a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_836109172.html">
								<img src="/sf/case-share-icon5.png">
							</a>
							</div>
							<div>
								<a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_591155569.html">
								<img src="/sf/case-share-icon3.png"></a>
									<a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_1045342821.html">
								<img src="/sf/case-share-icon4.png">
							</a>
							</div>
							</div>
					</div>
					</div>
</div>
			</div>
		</div>
		<div id="news-consultation">
			<div class="content">
				<div id="new_message_title">




  		<div class="title">
					新闻资讯<span>新闻资讯抢先知晓</span>

					   <a class="examination" href="https://www.sf-express.com/mobile/cn/sc/news/sf.blade.php">查看全部	&gt;</a>

				</div>


  </div>
				<div id="new_message_list">



<div class="wrapper">




							<a href="https://www.sf-express.com/mobile/cn/sc/news/detail/62a17c8b-c5a8-11eb-95c8-60c5479253e4/sf.blade.php">


						<div class="img">
							<img class="titlePage" src="/sf/SFcarbontargetwhite-paper2021.jpg">
						</div>

						<div class="text">
							<span>一图读懂顺丰控股碳目标白皮书</span>



															<p> 面对全球气候变化带来的挑战，作为一家肩负社会责任感的企业，顺丰基于过去的减碳成果 ...</p>

						</div>
					</a>







							<a href="https://www.sf-express.com/mobile/cn/sc/news/detail/b442df05-6add-11eb-8e84-60c5479253e4/sf.blade.php">

						<div class="img">
							<img class="titlePage" src="/sf/new-road.png">
						</div>

						<div class="text">
							<span>“智”创未来  “链”接全球--新征程 再出发</span>



																<p>“智”创未来  “链”接全球--新征程 再出发</p>

						</div>
					</a>







							<a href="https://www.sf-express.com/mobile/cn/sc/news/detail/6bd11169-69e6-11eb-8e84-60c5479253e4/sf.blade.php">

						<div class="img">
							<img class="titlePage" src="/sf/security1.png">
						</div>

						<div class="text">
							<span>顺丰积极参与网络安全国家标准制订定《快递物流服务数据安全指南》征求意见稿新鲜出炉</span>



															<p> 《信息安全技术 快递物流服务数据安全指南》是国家标准化管理委员会下达的信息安全国 ...</p>

						</div>
					</a>







							<a href="https://www.sf-express.com/mobile/cn/sc/news/detail/c3516803-4bd9-11ea-a707-60c5479253e4/sf.blade.php">

						<div class="img">
							<img class="titlePage" src="/sf/news20200210_3.jpg">
						</div>

						<div class="text">
							<span>湖北顺丰收到了一封来自武汉市交通运输局的“感谢信”</span>



																<p></p>

						</div>
					</a>







							<a href="https://www.sf-express.com/mobile/cn/sc/news/detail/-01159/sf.blade.php">

						<div class="img">
							<img class="titlePage" src="/sf/20200206NEWS_1.png">
						</div>

						<div class="text">
							<span>顺丰速运国际依托全球供应链资源全力支持医疗防疫物资运输</span>



																<p></p>

						</div>
					</a>







							<a href="https://www.sf-express.com/mobile/cn/sc/news/detail/800-00001/sf.blade.php">

						<div class="img">
							<img class="titlePage" src="/sf/20200206NEWS_2.png">
						</div>

						<div class="text">
							<span>顺丰航空已运输防疫物资超800吨</span>



																<p></p>

						</div>
					</a>



			</div>
</div>
			</div>
		</div>
		<div id="promotion">
			<div class="content">
				<div id="index_promotion_contents">





				</div>
</div>
			</div>
		</div>
		<div id="indexSignActive">
            <div id="signActiveClose" class="sign-active-close"></div>
        </div>



<script type="text/javascript" src="/sf/swiper3.1.0.min.js.下载"></script>
<script type="text/javascript" src="/sf/SfGather.js.下载"></script>
<script type="text/javascript" src="/sf/index.js.下载"></script>
<script>
	var _hmt = _hmt || [];

	(function() {
	  var hm = document.createElement("script");
	  hm.src = "https://hm.baidu.com/hm.js?9f2554f82ca977b8e009e1d7b2619be3";
	  var s = document.getElementsByTagName("script")[0];
	  s.parentNode.insertBefore(hm, s);
	})();
	var defaultUrl = "https://ocs2odp.sf-express.com/app/init?orgName=sy&channelId=659&clientType=1";
    function getOnlineService () {
		var url = ''
        $.ajax({
            url: "/sf-service-core-web/service/onlineService/getRedirectUrl",
            async: false,
            type: "get",
            data: {
                orgUrl: "https://ocs2odp.sf-express.com/app/init",
                channelId: "659",
                clientType: "1",
                orgName: "sy"
            },
            success: function(res) {
                if(res.code == 0){
                    url = res.result;
                }else{
                    url = defaultUrl;
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                url = defaultUrl
            }
        });
		return url
    };

    $(document).ready(function() {
        var isLogin = !!$.cookie("loginUser");
        // 马上联系我们-在线客服点击
        $("#mobileOnlineServiceUrl").click(function(e){
            e.stopPropagation();
			e.preventDefault();
            if(isLogin){
                var onlineUrl = getOnlineService();
				window.open(onlineUrl, '_blank')
            }else{
				window.open(defaultUrl, '_blank')
            }
        });
    });
</script>










<div id="footermb">


<footer style="margin-top: 0px;">
  <div id="footer">
		<div class="footer">
		    <div class="to-top" style="display: none;"></div>
			<ul class="nav_second">







								<li class="nav_list nav_list_hvoer">



										<a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query">快递产品<span class="b"></span></a>








<ul class="nav_two">

<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/city_distribution/SF_Rush/sf.blade.php">快递服务<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/express/cold_service/food_service/cold_shipped_home/sf.blade.php">冷运服务<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/express/medical_service/medical_service/room_temperature/sf.blade.php">医药服务<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/express/storage_service/storage_services/warehouse_management/sf.blade.php">仓储服务<span></span></a></li>

</ul>
								</li>







								<li class="nav_list nav_list_hvoer">



										<a href="https://ucmp.sf-express.com/v1/we/cx3.0/service-query/list?name=values&amp;type=%E5%A2%9E%E5%80%BC%E6%9C%8D%E5%8A%A1">增值服务<span class="b"></span></a>








<ul class="nav_two">

<li><a href="https://www.sf-express.com/mobile/cn/sc/express/express_service/city_distribution/SF_Rush/sf.blade.php">快递服务<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/express/cold_service/food_service/cold_shipped_home/sf.blade.php">冷运服务<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/express/medical_service/medical_service/room_temperature/sf.blade.php">医药服务<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/express/storage_service/storage_services/warehouse_management/sf.blade.php">仓储服务<span></span></a></li>

</ul>
								</li>







								<li class="nav_list nav_list_hvoer">



										<a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nt&amp;fa=pc&amp;">金融<span class="b"></span></a>








<ul class="nav_two">
<!--
    <li><a href="finance/supply_chain_finance/">供应链金融<span></span></a></li>
-->

     <li><a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nb&amp;fa=pc&amp;">资产管理<span></span></a></li>


    <li><a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nb&amp;fa=pc&amp;">财富管理<span></span></a></li>


    <li><a href="https://www.sf-financial.com/index.html?fc=ex&amp;fp=nb&amp;fa=pc&amp;">综合支付<span></span></a></li>


</ul>
								</li>







								<li class="nav_list nav_list_hvoer">


										<a class="a" href="javascript:;">成功案例<span></span></a>









 <ul class="nav_two">

	<li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/sf.blade.php">概览<span></span></a></li>


	<li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_364584038.html">3C电子行业<span></span></a></li>


   <li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_836109172.html">医药行业<span></span></a></li>


   <li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_591155569.html">生鲜行业<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/case_share/index.html_1045342821.html">快消行业<span></span></a></li>

</ul>
								</li>







								<li class="nav_list nav_list_hvoer">


										<a class="a" href="javascript:;">服务支持<span></span></a>












<ul class="nav_two">

   <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/order">我要寄件<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/waybill">运单追踪<span></span></a></li>


   <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/payFee/payFee.html">运费时效查询<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/range/range.html">收寄范围查询<span></span></a></li>


   <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_function/store/store.html">服务网点查询<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/accept/sf.blade.php">收寄标准查询<span></span></a></li>

</ul>
								</li>







								<li class="nav_list nav_list_hvoer">


										<a class="a" href="javascript:;">可持续发展<span></span></a>









<ul class="nav_two">

     <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/home">首页<span></span></a></li>


      <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/company">企业治理<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/innovation">绿色创新<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/community">人才伙伴<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/dynamic_functions/sustainable/partnership" target="_blank">社会关怀<span></span></a></li>

</ul>
								</li>







								<li class="nav_list nav_list_hvoer">


										<a class="a" href="javascript:;">投资者关系<span></span></a>










<ul class="nav_two">

    <li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/corporate_governance/sf.blade.php"> 公司治理<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/latest_announcements/sf.blade.php">公司公告<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/periodic_report/financial_statements/sf.blade.php">定期报告<span></span></a></li>


   <li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/stock_information/sf.blade.php">投资者联络<span></span></a></li>


    <li><a href="https://www.sf-express.com/mobile/cn/sc/investor_relations/investor_relations_calendar/board_meeting/sf.blade.php">投资者关系日历<span></span></a></li>

</ul>
								</li>







								<li class="nav_list nav_list_hvoer">


										<a class="a" href="javascript:;">关于我们<span></span></a>










<ul class="nav_two">

     <li><a href="https://www.sf-express.com/mobile/cn/sc/about_us/sf.blade.php">概览<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/about_us/about_sf/company_introduction/sf.blade.php">关于顺丰<span></span></a></li>


      <li><a href="https://www.sf-express.com/mobile/cn/sc/news/sf.blade.php">新闻资讯<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/notice/sf.blade.php">服务公告<span></span></a></li>


     <li><a href="https://www.sf-express.com/mobile/cn/sc/promotions/sf.blade.php">促销活动<span></span></a></li>


    <li><a href="http://hr.sf-express.com/sf.blade.php" target="_blank">人才招聘<span></span></a></li>

</ul>
								</li>






			<li class="nav_list nav_list_hvoer">
					<a href="https://www.sf-express.com/mobile/cn/sc/sf.blade.php#f8;" class="a" name="f8">联系我们<span></span></a>
					<ul class="nav_two">
						<!-- <li><a href="cooperative_consultation/">合作咨询<span></span></a></li>-->
						<li><a href="javascript:void(0)" id="contactUsOnlineUrl">在线客服<span></span></a></li>
						<li><a href="https://www.sf-express.com/cn/sc/Customer-Service-Hotlines/sf.blade.php">服务热线<span></span></a></li>
					</ul>
				</li>
			<li class="nav_list nav_list_hvoer">
					<a href="https://www.sf-express.com/mobile/cn/sc/#sf.blade.php" class="a" name="f9">相关连接<span></span></a>
					<ul class="nav_two">
						<li><a href="http://intl.sf-express.com/sf.blade.php" target="_blank">顺丰国际<span></span></a></li>
						<!-- <li><a href="http://dengta.sf-express.com/index"  target="_blank">顺丰数据灯塔<span></span></a></li> -->
						<li><a href="http://www.sf-airlines.com/sfa/zh/index.html" target="_blank">顺丰航空<span></span></a></li>
						<li><a href="http://www.sf-tech.com.cn/sf.blade.php" target="_blank">顺丰科技<span></span></a></li>
						<li><a href="https://www.sf-express.com/cn/sc/industrial_park/about_us/Introduction/sf.blade.php" target="_blank">顺丰产业园<span></span></a></li>
						<li><a href="https://www.sffix.cn/sffix/home.html?chn=173595CFF4554A79087301422BFE33A1&amp;hmsr=baidu&amp;hmpl=%E5%85%AC%E5%8F%B8&amp;hmcu=%E5%85%AC%E5%8F%B8&amp;hmkw=17&amp;hmci=" target="_blank">顺丰丰修<span></span></a></li>
						<!-- <li><a href="http://www.sfbuy.com/index"  target="_blank">海购丰运<span></span></a></li> -->
						<li><a href="http://www.sfgy.org/" target="_blank">顺丰公益<span></span></a></li>
						<!-- <li><a href="http://sf-saas.com/"  target="_blank">顺丰一站<span></span></a></li> -->
						<!-- <li><a href="http://hr.sf-express.com/"  target="_blank">顺丰招聘<span></span></a></li> -->
					</ul>
				</li>
					<li class="nav_list nav_list_hvoer">
					<a href="https://www.sf-express.com/mobile/cn/sc/#sf.blade.php" class="a" name="f9">协议政策<span></span></a>
					<ul class="nav_two">
						<li><a href="https://www.sf-express.com/mobile/cn/sc/use_clause/sf.blade.php" target="_blank">使用条款<span></span></a></li>
						<li><a href="https://www.sf-express.com/mobile/cn/sc/services_network/sf.blade.php" target="_blank">服务网络<span></span></a></li>
						<li><a href="https://www.sf-express.com/mobile/cn/sc/privacy_policy/sf.blade.php" target="_blank">隐私政策<span></span></a></li>
					</ul>
				</li>
				<li class="nav_list share">
					<a href="https://www.sf-express.com/mobile/cn/sc/#sf.blade.php" class="l_a" name="f9">马上联系我们</a>
					  <div class="share_z">
						<a target="_blank" href="http://weibo.com/sfsuyun?is_hot=1" class="weibo"></a>
						<a href="javascript:void(0);" class="weixin" id="weixin"></a>
						<a href="javascript:void(0)" class="service" id="nowContactUsOnlineUrl"></a>
						<div class="qr-code-popup">
						  <div class="img"><img src="/sf/erweima.jpg"></div>
						  <p>将二维码截图保存至相册，打开微信识别相册中的二维码关注</p>
						</div>
					  </div>
				</li>
				<li class="nav_list last">© 2017顺丰速运版权所有 粤ICP备08034243号</li>
          </ul>
		</div>
	</div>
</footer>
<script type="text/javascript">
    var defaultUrl = "https://ocs2odp.sf-express.com/app/init?orgName=sy&channelId=659&clientType=1";
    function getOnlineService () {
		var url = ''
        $.ajax({
            url: "/sf-service-core-web/service/onlineService/getRedirectUrl",
            async: false,
            type: "get",
            data: {
                orgUrl: "https://ocs2odp.sf-express.com/app/init",
                channelId: "659",
                clientType: "1",
                orgName: "sy"
            },
            success: function(res) {
                if(res.code == 0){
                    url = res.result;
                }else{
                    url = defaultUrl;
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                url = defaultUrl
            }
        });
		return url
    };

    $(document).ready(function() {
        var isLogin = !!$.cookie("loginUser");
        // 联系我们-在线客服点击
        $("#contactUsOnlineUrl").click(function(e){
            e.stopPropagation();
			e.preventDefault();
            if(isLogin){
                var onlineUrl = getOnlineService();
				window.open(onlineUrl, '_blank')
            }else{
				window.open(defaultUrl, '_blank')
            }
        });
        // 马上联系我们-在线客服点击
        $("#nowContactUsOnlineUrl").click(function(e){
            e.stopPropagation();
			e.preventDefault();
            if(isLogin){
                var onlineUrl = getOnlineService();
				window.open(onlineUrl, '_blank')
            }else{
				window.open(defaultUrl, '_blank')
            }
        });
    });

</script>
	</div>


<script type="text/javascript" src="/sf/configs.js.下载"></script>
<script type="text/javascript" src="/sf/common_functions.js.下载"></script>
<script type="text/javascript" src="/sf/common.js.下载"></script>
<script>
	var _hmt = _hmt || [];
	(function() {
  		var hm = document.createElement("script");
  			hm.src = "//hm.baidu.com/hm.js?32464c62d48217432782c817b1ae58ce";
  		var s = document.getElementsByTagName("script")[0];
  			s.parentNode.insertBefore(hm, s);
	})();
</script>

<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-96256643-1', 'auto');
    ga('send', 'pageview');
</script>



</body></html>
