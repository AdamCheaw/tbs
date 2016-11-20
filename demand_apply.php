<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0" name="viewport">
        <meta id="Viewport" name="viewport" width="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<title>TbS</title>
        <link rel="shortcut icon" href="img/favicon.ico" />
        <link rel="stylesheet" href="css/demand_apply_style.css" type="text/css" />
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
		<link rel="stylesheet" type="text/css" href="tab/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="tab/css/tabs.css" />
		<link rel="stylesheet" type="text/css" href="tab/css/tabstyles.css" />
  		<script src="tab/js/modernizr.custom.js"></script>
		<link rel="stylesheet" href="Web-Font/style.css"></head>
		
    </head>
    <body>
    <div id="wrapper">
        <?php 
			if(!isset($_SESSION['user_id'])){
				require ("login_page.php");
			}else{
				echo "<div id='header'>";
				echo "<div id='headerTopicContainer'></div>";
        		require ("header_login.php");
				echo "</div>";
		?>
            
			
			<div class="tabs tabs-style-underline">
					<nav>
						<ul>
							<li><a href="#section-underline-1" class="icon icon-box"><span>物品</span></a></li>
							<li><a href="#section-underline-2" class="icon icon-tools"><span>服務</span></a></li>
							<li><a href="#section-underline-3" class="icon2 icon-car"><span>共乘</span></a></li>
							<li><a href="#section-underline-4" class="icon icon-home"><span>空間</span></a></li>
							
						</ul>
					</nav>
					<div class="content-wrap">
					<div style="background-color:#f2f2f2;padding:10px;height:100px;line-height:15px" >
						<h2 id="thisH1">提出你的需求吧！！</h2>
						<p id="slogan">如果您找不到您的需求歡迎在這里提出來哦！</p>
					</div>
					
						<section id="section-underline-1">
						
                        <form action="demand_goods_insertdb.php" method="post" enctype="multipart/form-data">
                        <table class="thisTable" border="0">
                            <tr>
                              <td class="formLeft">物品名稱 : </td>
                              <td class="formRight"><input type="text" name="name" class="inputText" required></td>
                            </tr>
                            <tr>
                              <td class="formLeft">品牌 : </td>
                              <td class="formRight"><input type="text" name="brand" class="inputText" placeholder="如有，請填寫"></td>
                            </tr>
                            <tr>
								<td class="formLeft">幾號以前需要 : </td>
								<td class="formRight"><input type="date" name="need_date" class="inputDate" required></td>
                                <!--<td class="formLeft">照片 : </td>
                                <td class="formRight">
									<div class="input-button">
                                    <input type="file" name="image" id="inputFile" class="inputFile">
									</div>
                                    <div>
                                        <img class="preview" style="max-width: 150px; max-height:150px">
                                        <div class="size"></div>
                                    </div>
                                </td>-->
                            </tr>
                            <tr>
                              <td class="formLeft">願意支付的價格 : </td>
                              <td class="formRight"><input type="text" name="price" class="inputText" placeholder="ex:NT50 / NT100~NT200" required></td>
                            </tr>
                            <tr>
                              <td class="formLeft">描述 : </td>
                              <td class="formRight"><textarea name="description" class="inputTextArea"></textarea></td>
                            </tr>
                            <tr>
                                <td class="formLeft" id="thisA" colspan="2">
                                    <input type="checkbox" required>
                                    同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                </td>
                            </tr>
                            <tr><td>
                            	<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
                            </td></tr>
                        </table>
                        </form>
						</section>
						
						<section id="section-underline-2">
							<form action="demand_service_insertdb.php" method="post" enctype="multipart/form-data">
                        <table class="thisTable" border="0">
                            <tr>
                              <td class="formLeft">服務名稱：</td>
                              <td class="formRight"><input type="text" name="name" class="inputText" required></td>
                            </tr>
							<tr>
								<td class="formLeft">幾號以前需要 ： </td>
								<td class="formRight"><input type="date" name="need_date" class="inputDate" required></td>
							</tr>
                            <tr>
                              <td class="formLeft">願意支付的價格：</td>
                              <td class="formRight"><input type="text" name="price" class="inputText" placeholder="ex:NT50 / NT100~NT200" required></td>
                            </tr>
                            <tr>
                              <td class="formLeft">描述：</td>
                              <td class="formRight"><textarea name="description" class="inputTextArea"></textarea></td>
                            </tr>
                            <tr>
                                <td class="formLeft" id="thisA" colspan="2">
                                    <input type="checkbox" required>
                                    同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                </td>
                            </tr>
                            <tr><td>
                            	<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
                            </td></tr>
                        </table>
                        </form>
						</section>
						<section id="section-underline-3">
							
                        <form action="demand_vehicle_insertdb.php" method="post" enctype="multipart/form-data">
                        <table class="thisTable" border="0">
                            <tr>
                              <td class="formLeft">日期：</td>
                              <td class="formRight"><input type="date" name="vehicle_date" class="inputDate" required></td>
                            </tr>
                            <tr>
                              <td class="formLeft">時間：</td>
                              <td class="formRight"><input type="time" name="vehicle_time" class="inputTime" required></td>
                            </tr>
                            <tr>
                              <td class="formLeft">目的地：</td>
                              <td class="formRight"><input type="text" name="destination" class="inputText" required></td>
                            </tr>
                            <tr>
                              <td class="formLeft">可接受的費用：</td>
                              <td class="formRight"><input type="text" name="price" class="inputText" placeholder="ex:NT50 / NT100~NT200" required></td>
                            </tr>
                            <tr>
                              <td class="formLeft">其他要求：</td>
                              <td class="formRight"><textarea name="description" class="inputTextArea"></textarea></td>
                            </tr>
                            <tr>
                                <td class="formLeft" id="thisA" colspan="2">
                                    <input type="checkbox" required>
                                    同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                </td>
                            </tr>
                            <tr><td>
                            	<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
                            </td></tr>
                        </table>
                        </form>
						</section>
						<section id="section-underline-4">
							
                        <form action="demand_space_insertdb.php" method="post" enctype="multipart/form-data">
                        <table class="thisTable" border="0">
                            <tr>
                              <td class="formLeft">空間名稱：</td>
                              <td class="formRight"><input type="text" name="name" class="inputText" required></td>
                            </tr>
                            <tr>
								<td class="formLeft">幾號以前需要 ： </td>
								<td class="formRight"><input type="date" name="need_date" class="inputDate" required></td>
							</tr>
                            <tr>
                              <td class="formLeft">願意支付的價格：</td>
                              <td class="formRight"><input type="text" name="price" class="inputText" placeholder="ex:NT50 / NT100~NT200" required></td>
                            </tr>
                            <tr>
                              <td class="formLeft">描述：</td>
                              <td class="formRight"><textarea name="description" class="inputTextArea"></textarea></td>
                            </tr>
                            <tr>
                                <td class="formLeft" id="thisA" colspan="2">
                                    <input type="checkbox" required>
                                    同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                </td>
                            </tr>
                            <tr><td>
                            	<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
                            </td></tr>
                        </table>
                        </form>
						</section>
						
				    </div><!-- /content -->
			</div><!-- /tabs -->
            
		<?php
        	echo "<div id='this_footer'>";
			require ("footer.php");
        	echo "</div>";
        	
			}
		?>
	</div>
    <script type="text/javascript">
		var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
    </script>
	<script src="tab/js/cbpFWTabs.js"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="js/script-scroll.js"></script>
    <script>
		$(function (){
			function format_float(num, pos){
				var size = Math.pow(10, pos);
				return Math.round(num * size) / size;
			}
			function preview(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
						$('.preview').attr('src', e.target.result);
						var KB = format_float(e.total / 1024, 2);
						$('.size').text("檔案大小：" + KB + " KB");
					}
					reader.readAsDataURL(input.files[0]);
				}
			}
			$("body").on("change", ".inputFile", function (){
				preview(this);
			})
		})
	</script>
    <script src="js/libs_useso.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.toast.js"></script>
    <?php 
		if(isset ($_SESSION['noInsertDB'])){
			unset($_SESSION['noInsertDB']);
	?> 
		<script type="text/javascript">
			function Toast(){
				$.toast({
					text: "提出需求失敗，請重新輸入", // Text that is to be shown in the toast
					heading: 'Demand', // Optional heading to be shown on the toast
					icon: 'error', // Type of toast icon
					showHideTransition: 'slide', // fade, slide or plain
					allowToastClose: true, // Boolean value true or false
					hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
					stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
					position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
					textAlign: 'left',  // Text alignment i.e. left, right or center
					loader: true,  // Whether to show loader or not. True by default
					loaderBg: '#9ec600',  // Background color of the toast loader
				});
			}window.onload= Toast;
		</script>
	<?php }?>
    <?php 
		if(isset ($_SESSION['insertDB'])){
			unset($_SESSION['insertDB']);
	?>
    	<script type="text/javascript">
			function Toast(){
				$.toast({
					text: "確認提出需求", // Text that is to be shown in the toast
					heading: 'Demand', // Optional heading to be shown on the toast
					icon: 'sucess', // Type of toast icon
					showHideTransition: 'slide', // fade, slide or plain
					allowToastClose: true, // Boolean value true or false
					hideAfter: 2000, // false to make it sticky or number representing the miliseconds as time after which toast needs to be hidden
					stack: 5, // false if there should be only one toast at a time or a number representing the maximum number of toasts to be shown at a time
					position: 'bottom-left', // bottom-left or bottom-right or bottom-center or top-left or top-right or top-center or mid-center or an object representing the left, right, top, bottom values
					textAlign: 'left',  // Text alignment i.e. left, right or center
					loader: true,  // Whether to show loader or not. True by default
					loaderBg: '#9ec600',  // Background color of the toast loader
				});
			}window.onload= Toast;
		</script>
	<?php } ?>
    </body>
</html>