<?php
session_start();
require ("connMysql.php");
$type2 = $_GET['type2'];
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
		<title>TbS</title>
        <link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" href="css/supply-list-style.css" type="text/css" />
		<link rel="stylesheet" href="block-UI/style.css" type="text/css" />
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
		<script type="text/javascript" src="dropdown/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
	$("#firstpane .menu_body:eq(0)").show();
	$("#firstpane h3.menu_head").click(function(){
		$(this).addClass("current").next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	
	$("#secondpane .menu_body:eq(0)").show();
	$("#secondpane h3.menu_head").mouseover(function(){
		$(this).addClass("current").next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().removeClass("current");
	});
	
});
</script>

<style type="text/css">
.menu_list{width:200px;margin-left:3%;margin-right:2%;float:left;}
.menu_list .red{background:#996666 url(dropdown/images/pro_left.png) center right no-repeat;;}
.menu_head{
	height: 47px;
	line-height: 47px;
	padding-left: 38px;
	font-size: 14px;
	color: #525252;
	cursor: pointer;
	border-left: 1px solid #e1e1e1;
	border-right: 1px solid #e1e1e1;
	border-bottom: 1px solid #e1e1e1;
	border-top: 1px solid #F1F1F1;
	color:white;
	margin: 0px;
	font-weight: bold;
	background:#668c99 url(dropdown/images/pro_left.png) center right no-repeat;
}
.menu_list .current{background:#668c99 url(dropdown/images/pro_down.png) center right no-repeat;}
.menu_body{
	line-height: 38px;
	border-left: 1px solid #e1e1e1;
	backguound: #fff;
	border-right: 1px solid #e1e1e1;
	color:gray;
}
.menu_body a{display:block;height:38px;line-height:38px;padding-left:38px;background:#fff;text-decoration:none;color:gray;}
.menu_body a:hover{text-decoration:none;}
</style>
	</head>
	<body>
	<div id="wrapper">
		<div id="headerTopicContainer"></div>
        <header id="header">
        <?php 
            if(!isset($_SESSION['user_id'])){
                require ("header.php");
            }else{
                require ("header_login.php");
            }
        ?></header>
        <div id="wrapper-inner">
            <div id="firstpane" class="menu_list">
                <h3 class="menu_head current " >服務類</h3>
                <div style="display:block;" class="menu_body ">
                    <a href="supply_service_list.php?type2=all">查看所有</a>
                    <a href="supply_service_list.php?type2=bytime">按時算</a>
                    <a href="supply_service_list.php?type2=bypic">按件算</a>
                    <a href="supply_service_list.php?type2=other">其他</a>
                </div>
                
                <h3 class="menu_head" style="background-color:#667399">共乘類</h3>
                <div style="display:none" class="menu_body">
                    <a href="supply_vehicle_list.php?type2=all">查看所有</a>
                    <a href="supply_vehicle_list.php?type2=motor">機車</a>
                    <a href="supply_vehicle_list.php?type2=car">汽車</a>
                    <a href="supply_vehicle_list.php?type2=other">其他</a>
                </div>
                
                <h3 class="menu_head" style="background-color:#736699">物品類</h3>
                <div style="display:none" class="menu_body">
                    <a href="supply_goods_list.php?type2=all">查看所有</a>
                    <a href="supply_goods_list.php?type2=3C">3C</a>
                    <a href="supply_goods_list.php?type2=wear">穿搭</a>
                    <a href="supply_goods_list.php?type2=book">書籍</a>
                    <a href="supply_goods_list.php?type2=kitchenware">廚具</a>
                    <a href="supply_goods_list.php?type2=furniture">家具</a>
                    <a href="supply_goods_list.php?type2=camp">露營</a>
                    <a href="supply_goods_list.php?type2=sport">運動</a>
                    <a href="supply_goods_list.php?type2=other">其他</a>
                </div>
                
                <h3 class="menu_head" style="background-color:#8c6699">空間類</h3>
                <div style="display:none" class="menu_body">
                    <a href="supply_space_list.php?type2=all">查看所有</a>
                    <a href="supply_space_list.php?type2=stay">住宿</a>
                    <a href="supply_space_list.php?type2=store">儲藏</a>
                    <a href="supply_space_list.php?type2=other">其他</a>
                </div>
            </div>
            <div id="content">
			
				<?php
					$type2_array = array("bytime","bypic","other");
					$type2_cn = array("  /  按時算","  /  按件算","  /  其他");
					$tmp = "";
					for($i=0;$i<count($type2_array);$i++)
					{
						if($type2 == $type2_array[$i])
						{
							$tmp = $type2_cn[$i];
							
						}
					}
				?>
                <div id="thisH1"><h1 style="color:#476b6b">服務類<?php echo "<small style='color:#808080'>$tmp</small>";?></h1></div>
                <div id="ThisFilter">
					<div id="div1">
                    <form action="search_service_list.php" id="search_box" method="post">
					<div class="search-wrapper">
						<input type="hidden" name="action" value="searching">
                        <input type="text" id="search" name="search" placeholder="搜索" />
						<button type="submit" class="search_btn"><img src="img/search_icon.png" title="Search" /></button>
					</div>
                    </form>
					</div>
					<div id="div2">
					<form action="" method="POST">
							篩選條件 - <br/>
							<button name="filter" value="price DESC">價格-高至低</button>
                    		<button name="filter" value="price ASC">價格-低至高</button>
                    </form>
					</div>
					<div id="div3">
						<a href="demand_apply.php"><button id="button1"><h1>找不到你想要的嗎？<h1/><small>點我來提出你的需求吧！！</small></button></a>
					</div>
                </div>
                <div class="container">
                    <?php
                        $pagesize = 12;
						if($type2 == 'all'){
	                        $sql_total = "select count(*) from supply_list where s_type='service' and s_status = 'on'";
						}else{
							$sql_total = "select count(*) from supply_list where s_type='service' and s_type2='".$type2."' and s_status = 'on' ";
						}
                        $result_total = mysqli_query($db_conn,$sql_total);
                        $total = mysqli_fetch_row($result_total);
                        $totalpages = ceil($total[0]/$pagesize);
                        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {		// 取得當前的頁數，或者顯示預設的頁數
                            $currentpage = (int) $_GET['currentpage'];		// 把變量的類型轉換成 int
                            }else {
                                $currentpage = 1;		// 預設的頁數
                        }
                        $offset = ($currentpage - 1) * $pagesize;		// 根據當前頁數計算名單的起始位置
                    ?>
                    <div class="team-members row">
						<?php
                            if(isset($_POST['filter'])){
								$filter = $_POST['filter'];
								if($type2 == 'all'){
									$sql_query = "select a.*, b.*, c.* from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id  where s_type = 'service' and s_status = 'on' order by ".$_POST['filter']." LIMIT ".$offset.",".$pagesize.""; 
								}else{
									$sql_query = "select a.*, b.*, c.* from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id  where s_type = 'service' and s_status = 'on' and s_type2 = '".$type2."' order by ".$_POST['filter']." LIMIT ".$offset.",".$pagesize.""; 
								}
							}else if(isset($_GET['filter'])){
								$filter = $_GET['filter'];
								if($type2 == 'all'){
									$sql_query = "select a.*, b.*, c.* from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id  where s_type = 'service' and s_status = 'on' order by ".$_GET['filter']." LIMIT ".$offset.",".$pagesize."";
								}else{
									$sql_query = "select a.*, b.*, c.* from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id  where s_type = 'service' and s_status = 'on' and s_type2 = '".$type2."' order by ".$_GET['filter']." LIMIT ".$offset.",".$pagesize."";
								}
							}else{
								$filter = "post_date DESC";
								if($type2 == 'all'){
									$sql_query = "select a.*, b.*, c.* from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id  where s_type = 'service' and s_status = 'on' order by post_date DESC LIMIT ".$offset.",".$pagesize."";
								}else{
									$sql_query = "select a.*, b.*, c.* from supply_service_list a LEFT OUTER JOIN user_list b on a.provider = b.uid LEFT OUTER JOIN supply_list c on a.id = c.s_id where s_type = 'service' and s_status = 'on' and s_type2 = '".$type2."' order by post_date DESC LIMIT ".$offset.",".$pagesize."";
								}
							}
                            $result = mysqli_query($db_conn,$sql_query);
                            while($row = mysqli_fetch_array($result)){
								if($row["type2"] == "bytime")
											{
												$pic = "img/hourglass2.png";
											}
											else if($row["type2"] == "bypic")
											{
												$pic = "img/notepad.png";
											}
											else
											{
												$pic="img/customer-service.png";
											}
								echo "<div class='single-member effect-2'>";
									echo "<div class='member-image'>";
										echo "<a href='supply_service_detail2.php?id=".$row["id"]."' ><img src='$pic' alt='Member' ></a>";
									echo "</div>";
									echo "<div class='member-info'>";
										echo "<h3>".$row["name"]."</h3>";
										echo "<h5><small>by</small>".$row["nickname"]."<p class='price' >NT$ ".($row["price"])."</p></h5>";
										echo "<table border='0' id='info'>";
											echo "<tr>";
												echo "<td class='right'>工作內容：</td>";
												echo "<td class='left'>".mb_substr($row["description"],0,11,'UTF-8')."</td>";
											echo "</tr>";
											echo "<tr>";
												echo "<td class='right'>發帖時間： </td>";
												echo "<td class='left'>".date('d M Y',strtotime($row["post_date"]))."</td>";
											echo "</tr>";
										echo "</table>";
										echo "<div class='social-touch'>";
											echo "<a class='fb-touch' href='#'></a>";
											echo "<a class='tweet-touch' href='#'></a>";
											echo "<a class='linkedin-touch' href='#'></a>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
                            }
                        ?> 
                    </div>
                    <div id="page-bar">
						<ul>
						<?php
							if(ceil($total[0]) != 0){
								if ($currentpage > 1) {		// 若果正在顯示第一頁，無需顯示「前一頁」連結
									echo "<li><a href='supply_service_list.php?type2=".$type2."&currentpage=1&filter=".$filter."'> 第一頁 </a></li>";		// 使用 << 連結回到第一頁
									$prevpage = $currentpage - 1;		// 前一頁的頁數
									echo "<li><a href='supply_service_list.php?type2=".$type2."&currentpage=".$prevpage."&filter=".$filter."'>  <  </a></li>";			// 使用 < 連結回到前一頁
								}
								$range = 3; 	// 顯示的頁數範圍
								for ($x = (($currentpage - $range) - 1); $x < (($currentpage + $range) + 1); $x++) {  // 顯示當前分頁鄰近的分頁頁數
									if (($x > 0) && ($x <= $totalpages)) { 		// 如果這是一個正確的頁數...
										if ($x == $currentpage) {							// 如果這一頁等於當前頁數...
										echo "<li id='thisSelect'><a href='supply_service_list.php?type2=".$type2."&currentpage=".$x."&filter=".$filter."'>".($x)."</a></li>"; //不使用連結, 但用高亮度顯示
										} else {								// 如果這一頁不是當前頁數...
										echo "<li><a href='supply_service_list.php?type2=".$type2."&currentpage=".$x."&filter=".$filter."'>".($x)." </a></li>";		// 顯示連結
										} 
									} 
								} 
								 if ($currentpage != $totalpages) {	// 如果不是最後一頁, 顯示跳往下一頁及最後一頁的連結
									$nextpage = $currentpage + 1;		// 下一頁的頁數
									echo "<li><a href='supply_service_list.php?type2=".$type2."&currentpage=".$nextpage."&filter=".$filter."'>  >  </a></li>";			// 顯示跳往下一頁的連結
									echo "<li><a href='supply_service_list.php?type2=".$type2."&currentpage=".$totalpages."&filter=".$filter."'> 最後一頁 </a></li>";		// 顯示跳往最後一頁的連結
								}
								
								echo "<li>共".$totalpages."頁</li>";
								/*echo "總筆數".$total[0];
								for($i=0; $i<$totalpages; $i++){
									echo "<a href='supply_list.php?currentpage=".$i."'>第".($i+1)."頁 </a>";
								}*/
							}
                        ?>
                        </ul>
                    </div>
                </div>			    
            </div>
        </div>
        <footer id="this_footer">
			<?php require ("footer.php")?>
        </footer>
	</div>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="js/script-scroll.js"></script>
    <!--<script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>-->
	<script type="text/javascript" src="js/jquery.toast.js"></script>
	</body>
</html>