<?php
session_start();
require ("connMysql.php");

?>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
		<meta id="Viewport" name="viewport" width="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<title>TbS</title>
        <link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/mystyle.css" type="text/css" />
		<link id="noScriptCSS" rel="stylesheet" href="css/noscript.css">
        <link rel="stylesheet" href="css/slider-horizontal.css">
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
		<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
		<link rel="stylesheet" href="banner/demo.css" type="text/css" media="screen" />
		<script type="text/javascript" src="slider/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="slider/js/jquery.bxslider.js"></script>
		<link href="slider/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
		<style>
		    .title{border:0px solid #404040;font-family:Microsoft JhengHei ;padding:0px; line-height:0px;margin-top:0px;background-color:#404040;}
			.title p{font-family:Microsoft JhengHei ;color:#a3bac2;font-size:11pt;}
			.title table{border:0px solid white;width:290px;padding:0px;}
			.title td{border:0px solid white;height:10px;}
			.title .type{margin-top:-15px; margin-bottom:10px;}
			.title .name {vertical-align:bottom;text-align:right;padding-bottom:12px;}
			.title .name p{font-size:13pt}
			.title small{}
			.title h3{margin-top:4px;color:white;font-weight:500;}
			.wrapper2 h2{position:relative;right:100}
			.slide img{width:300px; height:210px}
			/*.hiSlider-item p{ width:100%; height:40px; font-size:20px; color:#333; line-height:40px; text-align:left; font-family:"微软雅黑"}*/
			.wrapper2 #t{text-align:middle;color:#333333;width:50%;margin-left:8%;margin-top:50px;font-size:20pt;font-family:Microsoft JhengHei ;line-height:10px;}
			.hiSlider-item{
			.slider-wrapper p{font-size:15pt;}
			margin-bottom: 20;
			width: 100%;
			padding: 6px 0;
			color: #fff;
			text-indent: 10px;
			
			z-index: 2;
			font: 14px/2 "Microsoft YaHei", "Arial", "Tahoma"
			}
		</style>
		<!--<link rel="stylesheet" href="banner/style.css" type="text/css" media="screen" />-->
	</head>
	<body>
	<div id="headerTopicContainer"></div>
			<div id="header">
			<?php 
				if(!isset($_SESSION['user_id'])){
					require ("header.php");
            	}else{
					require ("header_login.php");
				}
            ?></div>
	<div id="wrapper">
    	
		<div id = "columnContainer">
			<div class="slider-wrapper theme-theme1204">
            <div class="ribbon"></div>
            <div id="slider" class="nivoSlider">
                <img src="img/123.png" alt="" title="#sliderCaption1" />
                <img src="img/789.png" alt="" title="#sliderCaption3" />
				<img src="img/4567.png" alt="" title="#sliderCaption2" />
				<img src="img/2222.png" alt="" title="#sliderCaption4" />
            </div>
            <div id="sliderCaption1" class="nivo-html-caption">
				<h2 >一起來ShareShare </h2>
				<p >期許能夠透過平台的交流，讓大家可以透過平台將自己多餘的物資源利用共享的方式，達到資源利用的最大化及有效利用，也同時達到環保且經濟發展的概念</p>    
            </div>
			<div id="sliderCaption2" class="nivo-html-caption">
				<h2>立即報名</h2>
				<p>10/15 ~ 10/31 <br/>買了野餐墊還沒用過？想享受夏天的尾巴，可是又沒有人陪你？還在等甚麼？大家都準備好去溪頭了，你還不趕快來！！！</p>        
            </div>
			<div id="sliderCaption3" class="nivo-html-caption">
				<h2>人員招募中</h2>
				<p>11/15~12/24<br/>宿舍太小東西沒地方送，零用錢不夠用了，送歐趴糖送到破產了...這些都可以是你來交換的理由，來幫助身邊的你我他吧！</p>           
            </div>
			<div id="sliderCaption4" class="nivo-html-caption">
				<h2 >洪館 日月潭有機紅茶</h2>
				
				<p> 洪館老欉紅茶園，專注「自然農法」及「自然工法」來推廣這百年茶文化，「原生種百年山茶樹」的喉韻，在茶香滿意時，與您共度香茗時光。</p>    
            </div>
        </div>
			<!--<img src="img/creativity-819371_1920.jpg" height="100%" width="100%" >
			<div id ="background">
            <div id = "main">
				<!--<form name="f1" action="demand_apply.php" method="post">
            	<input type = "text" id="title" name="title" placeholder="我需要..."/>
				
				<form action="" id="search_box" method="post">
					<div class="search-wrapper">
						<input type="text" id="search" name="search" placeholder="我需要..." />
						<input type="hidden" name="action" value="searching" />
						<button type="submit" class="search_btn"><img src="img/search_icon.png" title="Search" /></button>
					</div>
                </form>
                
                <input id="button1" type="button" value="提出需求" onClick="location.href='demand_apply.php'">
                <p>or</p>
                <input id="button2" type="button" value="尋找你的需求" onClick="location.href='supply_list.php'">
				
				<div id= "column-inner">
                    <div id = "column-nav">
                        <ul>
                            <li><a href="#" style ="border-bottom:1px solid white">需求</a></li>
                            <li><a href="supply.php">提供</a></li>
                        </ul>
                    </div>
				</div>
			</div>
			</div>-->
		</div>
		<div class="sub-content">
        	<form action="search_goods_list.php" id="search_box" method="post">
					<div class="search-wrapper">
						<input type="text" id="search" name="search" placeholder="我想要..." />
						<input type="hidden" name="action" value="searching" />
						<button type="submit" class="search_btn"><img src="img/search_icon.png" title="Search" /></button>
					</div>
            </form>
			<a href="supply_list.php"><button id="button1"><h1 >享 , 我想<h1/><small>享用，看看大家都提供些什麼</small></button></a>
			<a href="supply_apply.php"><button id="button2"><h1>想 , 我享<h1/><small>分享，將您的閒置資產上架</small></button></a>
			<a href="demand_list.php"><button id="button3"><h1>我想 , 你来享<h1/><small>幫助這些未被滿足的需求吧！</small></button></a>
        </div>
		</div>
        <!--<img src="img/need.png" width="300px" height="120px">-->
     
    <div class="wrapper2"> 
	<p id="t">分享 . 精選</p>
    <div class="slider3">
      
      <div class="slide"><a href="supply_goods_detail2.php?id=11"><img src="uploadfile/bike.jpg" ></a><div class="title"><table><td><h3>白色自行車 </h3><p class="type">物品類</p></td><td class="name"><p>by 小俊子<p/></td></table></div></div>
      <div class="slide"><a href="supply_goods_detail2.php?id=7"><img src="uploadfile/camera-1248682_1920.jpg"></a><div class="title"><table><td><h3>數位相機</h3><p class="type">物品類</td><td class="name"><p>by Jane<p/></td></table></div></div>
      <div class="slide"><a href="supply_space_detail2.php?id=3"><img src="uploadfile/14407933_529801090544498_578238052_o.jpg"></a><div class="title"><table><td><h3>舒適寧靜小屋</h3><p class="type">空間類</p></td><td class="name"><p>by 仕翔<p/></td></table></div></div>
      <div class="slide"><a href="supply_space_detail2.php?id=4"><img src="uploadfile/14429248_529801080544499_771898531_n.jpg"></a><div class="title"><table><td><h3>置放雜物</h3><p class="type">空間類</p></td><td class="name"><p>by Jane<p/></td></table></div></div>
      <div class="slide"><a href="supply_space_detail2.php?id=1"><img src="uploadfile/P00026_01..jpg"></a><div class="title"><table><td><h3>儲藏室</h3><p class="type">空間類</p></td><td class="name"><p>by 小俊子<p/></td></table></div></div>
      <div class="slide"><a href="supply_vehicle_detail2.php?id=6"><img src="img/car1.jpg"></a><div class="title"><table><td><h3>從山下上去阿里山</h3><p class="type">共乘類</p></td><td class="name"><p>by 崇浩<p/></td></table></div></div>
      <div class="slide"><a href="supply_vehicle_detail2.php?id=2"><img src="img/motor1.jpg"></a><div class="title"><table><td><h3>從北車到台大</h3><p class="type">共乘類</p></td><td class="name"><p>by 賣家哦<p/></td></table></div></div>
      <div class="slide"><a href="supply_goods_detail2.php?id=9"><img src="uploadfile/skal.jpg"></a><div class="title"><table><td><h3>彩色酷炫滑板</h3><p class="type">物品類</p></td><td class="name"><p>by 仕翔<p/></td></table></div></div>
      <div class="slide"><a href="supply_goods_detail2.php?id=14"><img src="uploadfile/kkk.jpg"></a><div class="title"><table><td><h3>烤箱</h3><p class="type">物品類</p></td><td class="name"><p>by Jane<p/></td></table></div></div> 
    </div>
    </div>
	</div>
	
        <div id="this_footer">
			<?php require ("footer.php")?>
        </div>
	</div>
    
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="js/script-scroll.js"></script>
    <script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="banner/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="banner/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="banner/jquery.nivo.slider_2.5.2.js"></script>
	
	<script type="text/javascript" src="slider/js/jquery.bxslider.js"></script>
	<script src="js/slider.js"></script>
	<script type="text/javascript">
        $(document).ready(function(){
          $('.slider3').bxSlider({
			auto: true,
            slideWidth: 300,
            minSlides: 2,
            maxSlides: 4,
			moveSlides: 2,
            slideMargin: 10
          });
        });
    </script>
	<script type="text/javascript">
    $(window).load(function() {	
		$('#slider').nivoSlider({
			effect: 'random',//設定效果
			animSpeed:400,
			pauseTime:5000,
			startSlide:0,
			slices:15,
			directionNav:false,
			directionNavHide:false,
			controlNav:true,
			controlNavThumbs:false,
			keyboardNav:true,
			pauseOnHover:true,
			captionOpacity:0.8,
			afterLoad: function(){
				$(".nivo-caption").animate({left:"0"}, {easing:"easeOutBack", duration: 400})
			},
			beforeChange: function(){
				$(".nivo-caption").animate({left:"-400"}, {easing:"easeInBack", duration: 400})
			},
			afterChange: function(){
				$(".nivo-caption").animate({left:"0"}, {easing:"easeOutBack", duration: 400})
			}
		}); 
  	});
    </script>
    <script>
    $(function(){
        $("#slider-1").slider({
            direction: "left",
            auto: true,
			pause: false
        });
    });
	$(function(){
        $("#slider-2").slider({
            direction: "left",
            auto: false,
            pause: false
        });
    });
	$(function(){
        $("#slider-3").slider({
            direction: "left",
            auto: false,
            pause: false
        });
    });
	$(function(){
        $("#slider-4").slider({
            direction: "left",
            auto: false,
            pause: false
        });
    });
    </script>
    
	<script type="text/javascript" src="js/jquery.toast.js"></script>
	</body>
</html>