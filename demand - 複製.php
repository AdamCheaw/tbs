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
		<script type="text/javascript"></script>
	</head>
	<body>
	<div id="wrapper">
    	<div id="headerTopicContainer"></div>
			<div id="header">
			<?php 
				if(!isset($_SESSION['user_id'])){
					require ("header.php");
            	}else{
					require ("header_login.php");
				}
            ?></div>
		<div id = "columnContainer">
			
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
        <div id="sub-content">
        	<div id="new1">
            	<div>
                	<h1>最新活動</h1>
                </div>
            </div>
            <div id="new2">
            	<div>
                	<h1>最新促銷</h1>
                </div>
            </div>
        </div>
        <div id="s-outer-wrapper">
            <div id="s-wrapper">
                <div id="slider"><h2>物品上架</h2></div>
                <section id="ThisMain">
                    <div class="slideFrame" id="slider-1">
                        <ul class="slideGuide">
                            <?php
                                $sql_query = "select * from supply_goods_list a LEFT OUTER JOIN supply_list b on a.id = b.s_id where s_type='goods' order by post_date DESC limit 10";
                                $result = mysqli_query($db_conn,$sql_query);
                                while($row = mysqli_fetch_array($result)){
									if($row['s_status'] == "on"){
										if($row["image"] != 'uploadfile/itemicon.png'){
											echo "<li class='slideCell'><a href='supply_goods_detail.php?id=".$row["id"]."' target='_blank'><img src='".$row["image"]."' width='110' height='110'></a>";
										}
									}
                                }
                            ?>
                        </ul>
                        <div class="slideCtrl left"><</div>
                        <div class="slideCtrl right">></div>
                    </div>
                </section>
            </div>
            <div id="s-wrapper">
                <div id="slider"><h2>服務上架</h2></div>
                <section id="ThisMain">
                    <div class="slideFrame" id="slider-2">
                        <ul class="slideGuide">
                            <?php
                                $sql_query = "select * from supply_service_list a LEFT OUTER JOIN supply_list b on a.id = b.s_id where s_type='service' order by post_date DESC limit 10";
                                $result = mysqli_query($db_conn,$sql_query);
                                while($row = mysqli_fetch_array($result)){
									if($row['s_status'] == "on"){
                                		echo "<li class='slideCell'><a href='supply_service_detail.php?id=".$row["id"]."' target='_blank'><div id='ThisName'>".$row['name']."</div></a>";
									}
                                }
                            ?>
                        </ul>
                        <div class="slideCtrl left"><</div>
                        <div class="slideCtrl right">></div>
                    </div>
                </section>
                </div>
        	</div>
        </div>
        <div id="s-outer-wrapper">
            <div id="s-wrapper">
                <div id="slider"><h2>共乘上架</h2></div>
                <section id="ThisMain">
                    <div class="slideFrame" id="slider-3">
                        <ul class="slideGuide">
                            <?php
                                $sql_query = "select * from supply_vehicle_list a LEFT OUTER JOIN supply_list b on a.id = b.s_id where s_type='vehicle' order by post_date DESC limit 10";
                                $result = mysqli_query($db_conn,$sql_query);
                                while($row = mysqli_fetch_array($result)){
									if($row['s_status'] == "on"){
                                        echo "<li class='slideCell'><a href='supply_vehicle_detail.php?id=".$row["id"]."' target='_blank'><div id='ThisName'>".$row['destination']."</div></a>";
									}
                                }
                            ?>
                        </ul>
                        <div class="slideCtrl left"><</div>
                        <div class="slideCtrl right">></div>
                    </div>
                </section>
                </div>
        	</div>
            <div id="s-wrapper">
                <div id="slider"><h2>空間上架</h2></div>
                <section id="ThisMain">
                    <div class="slideFrame" id="slider-4">
                        <ul class="slideGuide">
                            <?php
                                $sql_query = "select * from supply_space_list a LEFT OUTER JOIN supply_list b on a.id = b.s_id where s_type='space' order by post_date DESC limit 10";
                                $result = mysqli_query($db_conn,$sql_query);
                                while($row = mysqli_fetch_array($result)){
									if($row['s_status'] == "on"){
										if($row["image"] != 'uploadfile/itemicon.png'){
											echo "<li class='slideCell'><a href='supply_space_detail.php?id=".$row["id"]."' target='_blank'><img src='".$row["image"]."' width='110' height='110'></a>";
										}
									}
                                }
                            ?>
                        </ul>
                        <div class="slideCtrl left"><</div>
                        <div class="slideCtrl right">></div>
                    </div>
                </section>
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
	<script src="js/slider.js"></script>
    <script>
    $(function(){
        $("#slider-1").slider({
            direction: "left",
            auto: false,
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