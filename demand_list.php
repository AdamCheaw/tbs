<?php
session_start();
require ("connMysql.php");
?>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
		<title>TbS</title>
        <link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/demand-list-style.css" type="text/css" />
		<link href="css/style.css" rel="stylesheet">
		
		<!--<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">-->
		<!--<script type="text/javascript" src="jquery-1.10.2.min.js"></script>-->
		<!--<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>-->
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
		<!--<link rel="stylesheet" type="text/css" href="tab/css/demo.css" />-->
		<link rel="stylesheet" type="text/css" href="tab/css/tabs.css" />
		<link rel="stylesheet" type="text/css" href="tab/css/tabstyles.css" />
  		<script src="tab/js/modernizr.custom.js"></script>
		<link rel="stylesheet" href="Web-Font/style.css"></head>
		
		<style type="text/css">
			#scrollDiv{ color:#333; font-size:15px;}
			h3,ul,li{margin:0;padding:0; list-style:none;}
			.scrollbox{ font-family:Microsoft JhengHei ;width: 300px;float:left;margin:20px 20px 20px 80px;  overflow: hidden; border: 1px solid #CFCFCF;border-radius:10px; padding: 10px; background-color:#fff;}
			.scrollbox h2{font-size:20px;font-family:Microsoft JhengHei ;color:#d22d2d;}
			#scrollDiv{width:300px;height:235px; overflow:hidden;border:1px solid #CFCFCF;background-color:#fff;margin-bottom:10px;}/*这里的高度和超出隐藏是必须的*/
			#scrollDiv li{font-family:Microsoft JhengHei;height:58px; width:280px; padding:0 20px;background:url(ico-4.gif) no-repeat 10px 23px; overflow:hidden; vertical-align:bottom; zoom:1; border-bottom:#CFCFCF dashed 1px;}
			#scrollDiv li h3{ height:24px; padding-top:13px; font-size:16px; color:#353535; line-height:24px; width:280px;}
			#scrollDiv li h3 a{color:#3d5c5c; text-decoration:none}#scrollDiv li h3 a:hover{ color:#F00}
			#scrollDiv li div{ height:36px; width:280px; color:black; line-height:18px; overflow:hidden}
			#scrollDiv li div a{ color:#416A7F; text-decoration:none}

			.scroltit{ height:26px; line-height:26px; padding-bottom:4px; margin-bottom:4px;}
			.scroltit h3{ width:100px; float:left;font-family:Microsoft JhengHei ;}
			.scroltit .updown{float:right; width:32px; height:22px; margin-left:4px}
			#but_up{ background:url(word-move/up.gif) no-repeat 0 0; text-indent:-9999px}
			#but_down{ background:url(word-move/down.gif) no-repeat 0 0; text-indent:-9999px}


			#n{margin:10px auto; width:920px; border:1px solid #CCC;font-size:12px; line-height:30px;}
			#n a{ padding:0 4px; color:#333}
			.tabs-style-bar nav ul li.tab-current a {
				background: #669999;
				color: #fff;
			}
		</style>
	
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
		<div id="ContentContainer">
			<div class="tabs tabs-style-bar">
					<nav>
						<ul>
							<li><a href="#section-bar-1" class="icon icon-box"><span>物品</span></a></li>
							<li><a href="#section-bar-2" class="icon icon-tools"><span>服務</span></a></li>
							<li><a href="#section-bar-3" class="icon2 icon-car"><span>共乘</span></a></li>
							<li><a href="#section-bar-4" class="icon icon-home"><span>空間</span></a></li>
							
						</ul>
					</nav>
					
					<div class="scrollbox">
					<h2 align="center"><strong>趕緊來幫助這些需求吧!!!</strong></h2>
					<div id="scrollDiv">
					<ul>
						<li><h3><a href="demand_goods_detail.php?id=7" class="linktit">20吋行李箱 倒數2天</a></h3> <div>誠意徵求一個20吋的行李箱 因為最近要北上比賽 西裝和高跟鞋等東西用包包裝不太方便 所以希望有人提供一個20吋的行李箱 以黑色等深色系為優先 希望有心人能拯救小妹 感謝萬分</div></li>
						<li><h3><a href="demand_goods_detail.php?id=9" class="linktit">多益練習本  倒數2天</a></h3> <div>要考多益 但是又不想去買參考書 覺得很貴 而且用一次之後便放著沒有用 希望有人可以藉給我 拜託幫幫忙啦 我可不可以畢業就靠你們了(￣∇￣) </div></li>
						<li><h3><a href="demand_vehicle_detail.php?id=8" class="linktit">考完期中考想回家一趟 倒數5天</a></h3> <div>我很健談的XD<br/>有人會開車 到宜蘭嗎? 我們可以一起回去哦！！</div></li>
						<li><h3><a href="demand_space_detail.php?id=11" class="linktit">徵求10至12人的派對空間  倒數5天</a></h3> <div>朋友下個月生日所以想找一個地方替他慶祝生日 最好可以有唱歌音響設備 </div></li>
						<li><h3><a href="demand_goods_detail.php?id=10" class="linktit">Iphone的充電器 倒數10天</a></h3> <div>白痴如我  上次回家之後便忘記了把我的iphone充電器拿回來=皿=現在生活在水深火熱之中 希望有人可以把手上閑置的iphone充電器借給我 請救救這個最近生活在原始人世界的人吧(╯з╰)</div></li>
					</ul>
					</div>
					<div class="scroltit"><div class="updown" id="but_down">向上</div><div class="updown" id="but_up">向下</div></div>
					</div>
					<div class="content-wrap">
						<section id="section-bar-1">
							<div id="entriesContainer" class="inner">
							<?php
								$sql_query = "select * from demand_list a LEFT OUTER JOIN user_list b on a.provider = b.uid order by post_date DESC";
								$result = mysqli_query($db_conn,$sql_query);
								while($row = mysqli_fetch_array($result)){
									if($row['type'] == "goods" && $row['d_status'] == "on"){
										echo "<div class='articlePost'>";
											echo "<div class='entry-pic'><img src=".$row["picture"]."></div>";
												echo "<div class='entry-contentContainer'>";
													echo "<div class='entry-title'>";
														echo "<h1>".mb_substr($row["name"],0,14,'UTF-8')."</h1>";
													echo "</div>";
													echo "<div class='entry-detail'>";
														echo "<p>需求者： ".$row["nickname"]."</p>";
														echo "<p>需要的時間： ".date('d M Y',strtotime($row["need_date"]))." 前</p>";
														echo "<p>描述: ".mb_substr($row["description"],0,35,'UTF-8')."..</p>";	
													echo "</div>";
												echo "</div>";
												echo "<div class='read_the_rest'>";
													echo "<p><a href='demand_goods_detail.php?id=".$row["id"]."'  class='btn'>查看詳細資料 </a></p>";
												echo "</div>";	
										echo "</div>";
									}
								}
							?>
						</div>
						</section>
						<section id="section-bar-2">
							<div id="entriesContainer" class="inner">
							<?php
                                $sql_query = "select * from demand_list a LEFT OUTER JOIN user_list b on a.provider = b.uid order by post_date DESC";
                                $result = mysqli_query($db_conn,$sql_query);
                                while($row = mysqli_fetch_array($result)){
									if($row['type'] == "service" && $row['d_status'] == "on"){
										echo "<div class='articlePost'>";
											echo "<div class='entry-pic'><img src=".$row["picture"]."></div>";
												echo "<div class='entry-contentContainer'>";
													echo "<div class='entry-title'>";
														echo "<h1>".mb_substr($row["name"],0,14,'UTF-8')."</h1>";
													echo "</div>";
													echo "<div class='entry-detail'>";
														echo "<p>需求者： ".$row["nickname"]."</p>";
														echo "<p>需要的時間： ".date('d M Y',strtotime($row["need_date"]))." 前</p>";
														echo "<p>描述: ".mb_substr($row["description"],0,35,'UTF-8')."..</p>";	
													echo "</div>";
												echo "</div>";
												echo "<div class='read_the_rest'>";
													echo "<p><a href='demand_service_detail.php?id=".$row["id"]."'  class='btn'>查看詳細資料 </a></p>";
												echo "</div>";	
										echo "</div>";
									}
								}
                            ?>
                    	</div>
						</section>
						<section id="section-bar-3">
							<div id="entriesContainer" class="inner">
							<?php
								$sql_query = "select * from demand_list a LEFT OUTER JOIN user_list b on a.provider = b.uid order by post_date DESC";
								$result = mysqli_query($db_conn,$sql_query);
								while($row = mysqli_fetch_array($result)){
									if($row['type'] == "vehicle" && $row['d_status'] == "on"){
										echo "<div class='articlePost'>";
											echo "<div class='entry-pic'><img src=".$row["picture"]."></div>";
												echo "<div class='entry-contentContainer'>";
													echo "<div class='entry-title'>";
														echo "<h1>".mb_substr($row["destination"],0,14,'UTF-8')."</h1>";
													echo "</div>";
													echo "<div class='entry-detail'>";
														echo "<p>需求者： ".$row["nickname"]."</p>";
														echo "<p>需要的時間： ".date('d M Y',strtotime($row["v_date"]))." 當天</p>";
														echo "<p>描述: ".mb_substr($row["description"],0,35,'UTF-8')."..</p>";	
													echo "</div>";
												echo "</div>";
												echo "<div class='read_the_rest'>";
													echo "<p><a href='demand_vehicle_detail.php?id=".$row["id"]."'  class='btn'>查看詳細資料 </a></p>";
												echo "</div>";	
										echo "</div>";
									}
								}
							?>
                    	</div>
						</section>
						<section id="section-bar-4">
							<div id="entriesContainer" class="inner">
							<?php
								$sql_query = "select * from demand_list a LEFT OUTER JOIN user_list b on a.provider = b.uid order by post_date DESC";
								$result = mysqli_query($db_conn,$sql_query);
								while($row = mysqli_fetch_array($result)){
									if($row['type'] == "space" && $row['d_status'] == "on"){
										echo "<div class='articlePost'>";
											echo "<div class='entry-pic'><img src=".$row["picture"]."></div>";
												echo "<div class='entry-contentContainer'>";
													echo "<div class='entry-title'>";
														echo "<h1>".mb_substr($row["name"],0,14,'UTF-8')."</h1>";
													echo "</div>";
													echo "<div class='entry-detail'>";
														echo "<p>需求者： ".$row["nickname"]."</p>";
														echo "<p>需要的時間： ".date('d M Y',strtotime($row["need_date"]))."前</p>";
														echo "<p>描述: ".mb_substr($row["description"],0,35,'UTF-8')."..</p>";	
													echo "</div>";
												echo "</div>";
												echo "<div class='read_the_rest'>";
													echo "<p><a href='demand_space_detail.php?id=".$row["id"]."'  class='btn'>查看詳細資料 </a></p>";
												echo "</div>";	
										echo "</div>";
									}
								}
							?>
                    	</div>
						</section>
						
					</div><!-- /content -->
				</div><!-- /tabs -->
	  		<!--<div id="TabbedPanels1" class="TabbedPanels">
				<ul class="TabbedPanelsTabGroup">
			    	<li class="TabbedPanelsTab" tabindex="0">物品</li>
			    	<li class="TabbedPanelsTab" tabindex="0">服務</li>
                    <li class="TabbedPanelsTab" tabindex="0">共乘</li>
                	<li class="TabbedPanelsTab" tabindex="0">空間</li>
		    	</ul>
				<div class="TabbedPanelsContentGroup">
					<div class="TabbedPanelsContent"><h1>物品類</h1>
                        <div id="entriesContainer" class="inner">
							<?php
								$sql_query = "select * from demand_list a LEFT OUTER JOIN user_list b on a.provider = b.uid order by post_date DESC";
								$result = mysqli_query($db_conn,$sql_query);
								while($row = mysqli_fetch_array($result)){
									if($row['type'] == "goods" && $row['d_status'] == "on"){
										echo "<div class='articlePost'>";
											echo "<div class='entry-pic'><img src=".$row["picture"]."></div>";
												echo "<div class='entry-contentContainer'>";
													echo "<div class='entry-title'>";
														echo "<h1>".$row["name"]."</h1>";
													echo "</div>";
													echo "<div class='entry-detail'>";
														echo "<p>需求者： ".$row["nickname"]."</p>";
														echo "<p>發帖時間： ".date('d M Y',strtotime($row["post_date"]))."</p>";
														echo "<p>描述: ".$row["description"]."</p>";	
													echo "</div>";
												echo "</div>";
												echo "<div class='read_the_rest'>";
													echo "<p><a href='demand_goods_detail.php?id=".$row["id"]."'  class='btn'>查看詳細資料 </a></p>";
												echo "</div>";	
										echo "</div>";
									}
								}
							?>
						</div>
                 	</div>
                    <div class="TabbedPanelsContent"><h1>服務類</h1>
                    	<div id="entriesContainer" class="inner">
							<?php
                                $sql_query = "select * from demand_list a LEFT OUTER JOIN user_list b on a.provider = b.uid order by post_date DESC";
                                $result = mysqli_query($db_conn,$sql_query);
                                while($row = mysqli_fetch_array($result)){
									if($row['type'] == "service" && $row['d_status'] == "on"){
										echo "<div class='articlePost'>";
											echo "<div class='entry-pic'><img src=".$row["picture"]."></div>";
												echo "<div class='entry-contentContainer'>";
													echo "<div class='entry-title'>";
														echo "<h1>".$row["name"]."</h1>";
													echo "</div>";
													echo "<div class='entry-detail'>";
														echo "<p>需求者： ".$row["nickname"]."</p>";
														echo "<p>發帖時間： ".date('d M Y',strtotime($row["post_date"]))."</p>";
														echo "<p>描述: ".$row["description"]."</p>";	
													echo "</div>";
												echo "</div>";
												echo "<div class='read_the_rest'>";
													echo "<p><a href='demand_service_detail.php?id=".$row["id"]."'  class='btn'>查看詳細資料 </a></p>";
												echo "</div>";	
										echo "</div>";
									}
								}
                            ?>
                    	</div>
                    </div>
                    <div class="TabbedPanelsContent"><h1>共乘類</h1>
                        <div id="entriesContainer" class="inner">
							<?php
								$sql_query = "select * from demand_list a LEFT OUTER JOIN user_list b on a.provider = b.uid order by post_date DESC";
								$result = mysqli_query($db_conn,$sql_query);
								while($row = mysqli_fetch_array($result)){
									if($row['type'] == "vehicle" && $row['d_status'] == "on"){
										echo "<div class='articlePost'>";
											echo "<div class='entry-pic'><img src=".$row["picture"]."></div>";
												echo "<div class='entry-contentContainer'>";
													echo "<div class='entry-title'>";
														echo "<h1>".$row["destination"]."</h1>";
													echo "</div>";
													echo "<div class='entry-detail'>";
														echo "<p>需求者： ".$row["nickname"]."</p>";
														echo "<p>發帖時間： ".date('d M Y',strtotime($row["post_date"]))."</p>";
														echo "<p>描述: ".$row["description"]."</p>";	
													echo "</div>";
												echo "</div>";
												echo "<div class='read_the_rest'>";
													echo "<p><a href='demand_vehicle_detail.php?id=".$row["id"]."'  class='btn'>查看詳細資料 </a></p>";
												echo "</div>";	
										echo "</div>";
									}
								}
							?>
                    	</div>
                    </div>
                    <div class="TabbedPanelsContent"><h1>空間類</h1>
                        <div id="entriesContainer" class="inner">
							<?php
								$sql_query = "select * from demand_list a LEFT OUTER JOIN user_list b on a.provider = b.uid order by post_date DESC";
								$result = mysqli_query($db_conn,$sql_query);
								while($row = mysqli_fetch_array($result)){
									if($row['type'] == "space" && $row['d_status'] == "on"){
										echo "<div class='articlePost'>";
											echo "<div class='entry-pic'><img src=".$row["picture"]."></div>";
												echo "<div class='entry-contentContainer'>";
													echo "<div class='entry-title'>";
														echo "<h1>".$row["name"]."</h1>";
													echo "</div>";
													echo "<div class='entry-detail'>";
														echo "<p>需求者： ".$row["nickname"]."</p>";
														echo "<p>發帖時間： ".date('d M Y',strtotime($row["post_date"]))."</p>";
														echo "<p>描述: ".$row["description"]."</p>";	
													echo "</div>";
												echo "</div>";
												echo "<div class='read_the_rest'>";
													echo "<p><a href='demand_space_detail.php?id=".$row["id"]."'  class='btn'>查看詳細資料 </a></p>";
												echo "</div>";	
										echo "</div>";
									}
								}
							?>
                    	</div>
                    </div>
		    	</div>
		  	</div>-->
    	</div>
        <div id="this_footer">
			<?php require ("footer.php")?>
        </div> 
	</div>
    
	<script src="word-move/jquery-1.4.4.min.js" type="text/javascript"></script>
		<script src="word-move/jq_scroll.js" type="text/javascript"></script>
		<script type="text/javascript">
		    $(document).ready(function(){
        	$("#scrollDiv").Scroll({line:1,speed:500,timer:3000,up:"but_up",down:"but_down"});
			});
		</script>
	<script src="js/script-scroll.js"></script>
    <!--<script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="js/jquery.toast.js"></script>
	<script src="tab/js/cbpFWTabs.js"></script>
	
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
	</body>
</html>