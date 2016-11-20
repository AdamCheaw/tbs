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
        <link rel="stylesheet" href="css/supply_apply_style.css" type="text/css" />
        <link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
		<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
		<link rel="stylesheet" type="text/css" href="tab/css/demo.css" />
		<link rel="stylesheet" type="text/css" href="tab/css/tabs.css" />
		<link rel="stylesheet" type="text/css" href="tab/css/tabstyles.css" />
		<link rel="stylesheet" href="Web-Font/style.css"></head>
  		<script src="tab/js/modernizr.custom.js"></script>
        <script>
		function chg(){
			var obj = document.getElementById("trans_oth");
			if(trans.checked==true){
				$('.trans_oth').removeAttr("readonly");	
			}else if(trans.checked!=true){
				$('.trans_oth').attr("readonly","readonly");
				obj.value = "";
			}
		}
		function chg2_2(){
			if(fitting2.checked==true){
				$('.fitting_yes').removeAttr("readonly");
			}
		}
		function chg2_1(){
			var obj = document.getElementById("fitting_yes");
			if(fitting1.checked==true){
				$('.fitting_yes').attr("readonly","readonly");
				obj.value = "";	
			}	
		}
		function chg3_2(){
			if(advise2.checked==true){
				$('.advise_yes').removeAttr("readonly");
			}
		}
		function chg3_1(){
			var obj = document.getElementById("advise_yes");
			if(advise1.checked==true){
				$('.advise_yes').attr("readonly","readonly");
				obj.value = "";	
			}
		}
		function chg4_2(){
			if(mid2.checked==true){
				$('.mid_yes').removeAttr("readonly");
			}
		}
		function chg4_1(){
			var obj = document.getElementById("mid_yes");
			if(mid1.checked==true){
				$('.mid_yes').attr("readonly","readonly");
				obj.value = "";	
			}
		}
		function Schg(){
			var obj = document.getElementById("public_oth");
			if(public.checked==true){
				$('.public_oth').removeAttr("readonly");	
			}else if(public.checked!=true){
				$('.public_oth').attr("readonly","readonly");
				obj.value = "";
			}
		}
		function Schg2(){
			var obj = document.getElementById("fac_oth");
			if(facilities.checked==true){
				$('.fac_oth').removeAttr("readonly");	
			}else if(facilities.checked!=true){
				$('.fac_oth').attr("readonly","readonly");
				obj.value = "";
			}
		}
        </script>
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
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
		<div class="tabs tabs-style-iconbox">
					<nav>
						<ul>
							<li><a href="#section-iconbox-1" class="icon icon-box"><span>物品上架</span></a></li>
							<li><a href="#section-iconbox-2" class="icon icon-tools"><span>服务上架</span></a></li>
							<li><a href="#section-iconbox-3" class="icon2 icon-car"><span>共乘上架</span></a></li>
							<li><a href="#section-iconbox-4" class="icon icon-home"><span>空間上架</span></a></li>
							
						</ul>
					</nav>
					<div class="content-wrap">
						<section id="section-iconbox-1">
							<fieldset><h1 class="ThisH1">物品上架</h1><hr/>
							<form action="supply_goods_insertdb.php" method="post" enctype="multipart/form-data">
                                <table class="ThisTable" border="0">
									<tr >
										<td class="formLeft">物品名稱 : </td><td class="formRight"><input type="text" name="name" class="inputText" required></td>
									</tr>
									<tr>
										<td class="formLeft">類別 : </td>
                                        <td class="formRight">
                                            <select name = "type2" class="inputSelect">
                                                <option value="3C">3C</option>
                                                <option value="wear">穿搭</option>
                                                <option value="book">書籍</option>
                                                <option value="kitchenware">廚具</option>
                                                <option value="furniture">家具</option>
                                                <option value="camp">露營</option>
                                                <option value="sport">運動</option>
                                                <option value="other">其他</option>
                                            </select>
                                        </td>
									</tr>
									<tr >
										<td class="formLeft">功能 : </td><td class="formRight" ><textarea name="description" class="inputTextArea"  placeholder="ex:適合拍攝影片" required></textarea></td>
									</tr>
									<tr>
										<td class="formLeft">品牌 : </td><td class="formRight"><input type="text" name="brand" class="inputText" placeholder="如適用"></td>
									</tr>
									<tr>
										<td class="formLeft">租借價格 : </td><td class="formRight" ><input type="text" name="price" class="inputText" required> (NT) </td>
									</tr>
                                    <tr>
                                    	<td class="formLeft">數量 : </td><td class="formRight"><input type="number" name="quantity" class="inputNumber" min="1" required> 個</td>
                                    </tr>
									<tr>
										<td class="formLeft">原有損壞的地方 : </td><td class="formRight"><textarea name="damaged_part" class="inputTextArea" placeholder="說明，描述"></textarea></td>
									</tr>
									<tr>
										<td class="formLeft">是否要配件才可使用 : </td>
										<td class="formRight">
											<label class="inputRadio"><input type="radio" name="fitting" id="fitting1" value="否" onClick="chg2_1()" required>否</label><br/>
											<label class="inputRadio"><input  type="radio"  name="fitting" id="fitting2" value="是" onClick="chg2_2()" required>是</label><textarea name="fitting_yes" class="fitting_yes inputTextArea" id="fitting_yes" placeholder="配件是否加購，或是已經包含" readonly></textarea>
										</td>
									</tr>
									<tr>
										<td class="formLeft">加購配件 : </td><td class="formRight"><input type="text" name="add_purchase" class="inputText"></td>
									</tr>
									<tr>
										<td class="formLeft" >物品圖片 : </td>
										<td class="formRight">
											<input type="file" name="image" class="inputFile" id="inputFile">
											<div>
												<img class="preview" style="max-width: 150px; max-height:150px">
												<div class="size"></div>
											</div>
										</td>
									</tr>
                                    <tr>
                                        <td class="formCenter" id="thisA" colspan="2">
                                            <input type="radio" name="protocol" required>
                                            同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                        </td>
                                    </tr>
								  </table>
								  <div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
							</form>
							</fieldset>
							<div class="question">
								<h1>上架須知</h1>
								<ul>
									<li>上架物品以可多次利用、重複使用者且未嚴重損壞為佳</li>
									<li>上架物品欲共享前須事前清理乾淨並保持清潔</li>
									<li>上架物品不得含危險性物品，如:槍枝、刀械及爆裂物等危險性物品(若有違反相關規定，須負民法及刑事責任，並立即下架</li>
									<li>上架需先行審核物品的完整性，如有毀損處請明確告知，並拍照或標示</li>
									<li>上架務必上傳物品的照片，以供需求者更為精準的判斷</li>
									<li>如需搭配額外配件，須明確告知</li>
								<ul/>
							</div>
						</section>
						<section id="section-iconbox-2">
							<fieldset><h1 class="ThisH1">服務提供</h1><hr/>
							<form action="supply_service_insertdb.php" method="post" enctype="multipart/form-data">
								<table class="ThisTable" border="0">
								<tr >
									<td class="formLeft">服務提供名稱 : </td><td class="formRight"><input type="text" name="name" class="inputText" placeholder="ex:服務、代班" required></td>
								</tr>
								<tr>
                                    <td class="formLeft">類別 : </td>
                                    <td class="formRight">
                                        <select name = "type2" class="inputSelect">
                                            <option value="bytime">按時算</option>
                                            <option value="bypic">按件算</option>
                                            <option value="other">其他</option>
                                        </select>
                                    </td>
                                </tr>
								<tr>
									<td class="formLeft">提供的時間 : </td><td class="formRight"><input type="text" name="service_time" class="inputText" placeholder="早上、晚上或可議" required> </td>
								</tr>
								
								
								<tr>
									<td class="formLeft">薪資計算 : </td><td class="formRight"><input type="text" name="price" class="inputText" placeholder="按時、按件數" required> (NT) </td>
								</tr>
								<tr>
									<td class="formLeft">提供對象 : </td><td class="formRight"><input type="text" name="target" class="inputText" placeholder="學生、老人" required> </td>
								</tr>
								<tr>
									<td class="formLeft">工作內容 : </td><td class="formRight"><textarea name="detail" class="inputTextArea" style="height:100px"required></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">備註 : </td><td class="formRight"><input type="text" name="special" class="inputText" placeholder="有什麼特別需求？" > </td>
								</tr>
                                <tr>
                                    <td class="formCenter" id="thisA" colspan="2">
                                        <input type="radio" name="protocol" required>
                                        同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                    </td>
                                </tr>
								</table>
								<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
							</form>
							</fieldset>
							<div class="question">
							<h1>上架須知</h1>
								<ul>
									<li>不得提供任何具危險、違法及性行為相關的服務，ex:性交易等</li>
									<li>提供該服務的對象，須明確告知清楚，如:家教對象為國小學生。</li>
									<li>提供服務若有特殊要求須事先告知清楚。</li>								
									
								<ul>
							</div>
						</section>
						<section id="section-iconbox-3">
							<fieldset><h1 class="ThisH1">共乘上架</h1><hr/>
							<form action="supply_vehicle_insertdb.php" method="post" enctype="multipart/form-data">
								<table class="ThisTable" border="0">
								<tr>
									<td class="formLeft">目的地 : </td><td class="formRight"><input type="text" name="destination" class="inputText" required></td>
								</tr>
                                <tr>
                                    <td class="formLeft">類別 : </td>
                                    <td class="formRight">
                                        <select name = "type2" class="inputSelect">
                                            <option value="car">汽車</option>
                                            <option value="motor">機車</option>
                                            <option value="other">其他</option>
                                        </select>
									</td>
                                </tr>
								<tr >
									<td class="formLeft">出發日期與時間 : </td><td class="formRight"><input type="datetime-local" name="vehicle_date" class="inputDatetime" required></td>
								</tr>
								
								
								<tr>
									<td class="formLeft">集合地點 : </td><td class="formRight"><textarea name="meet_place" class="inputTextArea" required></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">費用 : </td><td class="formRight"><input type="text" name="price" class="inputText" placeholder="ex:300/人" required> (NT) </td>
								</tr>
								
								<tr>
									<td class="formLeft">共乘人數 : </td><td class="formRight"><input type="number" name="num_ppl" class="inputNumber" placeholder="乘客的人數" min="1" required> 人</td>
								</tr>
								<tr>
									<td class="formLeft">車子的款式 : </td><td class="formRight"><textarea name="vehicle_brand" class="inputTextArea" placeholder="ex:豐田xx"></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">途徑的道路 : </td><td class="formRight"><input type="text" name="road" class="inputText" placeholder="ex:國六/國一/台16"></td>
								</tr>
                                <tr>
                                    <td class="formLeft">是否接受中途下車 : </td>
                                    <td class="formRight">
                                        <label><input type="radio" name="mid_getoff" id="mid1" onClick="chg4_1()" value="否">否</label><br/>
                                        <label><input type="radio"  name="mid_getoff" id="mid2" value="是" onClick="chg4_2()" required>是</label><textarea name="mid_yes" class="mid_yes" id="mid_yes" placeholder="ex:去彰化的車，可以在台中下車" readonly></textarea>
                                    </td>
								</tr>
                                
                                <tr>
									<td class="formLeft">備註 : </td><td class="formRight"><textarea name="remind" class="inputTextArea" ></textarea></td>
								</tr>
                                <tr>
                                    <td class="formCenter" id="thisA" colspan="2">
                                        <input type="radio" name="protocol" required>
                                        同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                    </td>
                                </tr>
								</table>
								<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
							</form>
							</fieldset>
							<div class="question">
							<h1>上架須知</h1>
								<ul>
									<li>共乘上架須明確告知可乘載人數，不得有任何超載的危險行為</li>
									<li>共乘上架須明確告知欲行經路徑</li>
									<li>共乘上架需含有中華民國有效的駕照、行照，若無照駕駛將自負民、刑事責任</li>
									<li>共乘上架若有特殊需求或注意事項須明確告知</li>
									
								<ul/>
							</div>
						</section>
						<section id="section-iconbox-4">
							<fieldset><h1 class="ThisH1">空間上架</h1><hr/>
							<form  action="supply_space_insertdb.php" method="post" enctype="multipart/form-data">
								<table class="ThisTable" border="0">
								<tr >
									<td class="formLeft">空間名稱 : </td><td class="formRight"><input type="text" name="name" class="inputText" placeholder="ex:小型開會空間" required></td>
								</tr>
								<tr>
                                    <td class="formLeft">類別 : </td>
                                    <td class="formRight">
                                        <select name = "type2" class="inputSelect">
                                            <option value="stay">住宿</option>
                                            <option value="store">儲藏</option>
                                            <option value="other">其他</option>
                                        </select>
									</td>
                                </tr>
								<tr >
									<td class="formLeft">地點 : </td><td class="formRight"><input type="text" name="location" class="inputText" placeholder="ex:管院 R103" required></td>
								</tr>
								
								<tr>
									<td class="formLeft">大小 : </td><td class="formRight"><textarea name="size" style="padding-bottom:15px;" class="inputTextArea" placeholder="說明，坪數、大小、或以人數容量概估，ex：4坪、可容納4人" required></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">建議使用人數 : </td><td class="formRight"><input type="text" name="num_ppl" class="inputText" placeholder="ex:3~5人" required></td>
								</tr>
								<tr>
									<td class="formLeft">租借價格 : </td><td class="formRight"><input type="text" name="price" class="inputText" placeholder="ex:以天計算、以時計算" required> (NT) </td>
								</tr>
								<tr>
									<td class="formLeft">使用期限 : </td>
									<td class="formRight">
										開始-> <input type="date" class="inputDate" name="d_start" required><br/>
										結束-> <input type="date" class="inputDate" name="d_stop" required>
									</td>
								</tr>
								
								<tr>
									<td class="formLeft">空間內設備 : </td>
									<td class="formRight">
										<label><input type="checkbox" name="facilities[]" value="電視" required>電視</label>
										<label><input type="checkbox" name="facilities[]" value="電腦" required>電腦</label>
										<label><input type="checkbox" name="facilities[]" value="投影機" required>投影機</label><br/>
										<label><input type="checkbox" name="facilities[]" value="印表機" required>印表機</label>
										<label><input type="checkbox" name="facilities[]" value="冷氣" required>冷氣</label>
										<label><input type="checkbox" name="facilities[]" value="電風扇" required>電風扇</label><br/>
										<label><input type="checkbox" name="facilities[]" value="冰箱" required>冰箱</label>
										<label><input type="checkbox" name="facilities[]" value="儲物櫃" required>儲物櫃</label>
										<label><input type="checkbox" name="facilities[]" value="網絡" required>網絡</label><br/>
										<label><input type="checkbox" name="facilities[]" value="桌子" required>桌子</label>
										<label><input type="checkbox" name="facilities[]" value="室內廁所" required>椅子</label><br/>
										<label><input type="checkbox" name="facilities[]" id="facilities" value="其他" onClick="Schg2()" required>其他 : </label><textarea name="fac_oth" class="fac_oth" id="fac_oth" cols="50" rows="1" readonly></textarea>
									</td>
								</tr>
								<tr>
									<td class="formLeft">附設設備收費 : </td><td class="formRight"><textarea name="fac_with" class="inputTextArea" placeholder="ex:冷氣(NT5/per hour)"></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">空間圖片 : </td>
									<td class="formRight">
										<input type="file" name="image" class="inputFile" id="inputFile">
										<div>
											<img class="preview" style="max-width: 150px; max-height:150px">
											<div class="size"></div>
										</div>
									</td>
								</tr>
                                <tr>
                                    <td class="formCenter" id="thisA" colspan="2">
                                        <input type="radio" name="protocol" required>
                                        同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                    </td>
                                </tr>
								</table>
								<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
							</form>
							</fieldset>
							<div class="question">
								
								<h1>上架須知</h1>
								<ul>
									<li>空間地點須於可到達之處，不得上架交通到達不便之處</li>
									<li>空間欲共享前需清理乾淨並保持清潔</li>
									<li>空間中若欲額外收費的物品請特別告知</li>
									<li>空間中具危險防護設備為佳，如:滅火器、煙霧警鈴等</li>
									<li>空間上架後，須明確告知使用時注意事項</li>
									
								<ul>		
							</div>
						</section>
						
					</div><!-- /content -->
				</div><!-- /tabs -->
        		<!--<div id="TabbedPanels1" class="TabbedPanels">
					<ul class="TabbedPanelsTabGroup" id="TPTG">
						<li class="TabbedPanelsTab" id="TPT" tabindex="0">物品上架</li>
						<li class="TabbedPanelsTab" id="TPT" tabindex="0">服務上架</li>
                        <li class="TabbedPanelsTab" id="TPT" tabindex="0">共乘上架</li>
						<li class="TabbedPanelsTab" id="TPT" tabindex="0">空間上架</li>
					</ul>
					<div class="TabbedPanelsContentGroup">
						<div class="TabbedPanelsContent">
							<fieldset><h1 class="ThisH1">物品上架</h1><hr/>
							<form action="supply_goods_insertdb.php" method="post" enctype="multipart/form-data">
                                <table class="ThisTable" border="0">
									<tr >
										<td class="formLeft">物品名稱:</td><td class="formRight"><input type="text" name="name" class="inputText" required></td>
									</tr>
									<tr>
										<td class="formLeft">類別:</td>
                                        <td class="formRight">
                                            <select name = "type2" class="inputSelect">
                                                <option value="3C">3C</option>
                                                <option value="wear">穿搭</option>
                                                <option value="book">書籍</option>
                                                <option value="kitchenware">廚具</option>
                                                <option value="furniture">家具</option>
                                                <option value="camp">露營</option>
                                                <option value="sport">運動</option>
                                                <option value="other">其他</option>
                                            </select>
                                        </td>
									</tr>
									<tr >
										<td class="formLeft">功能:</td><td class="formRight" ><textarea name="description" class="inputTextArea"  placeholder="ex:適合拍攝影片" required></textarea></td>
									</tr>
									<tr>
										<td class="formLeft">品牌:</td><td class="formRight"><input type="text" name="brand" class="inputText" placeholder="如適用"></td>
									</tr>
									<tr>
										<td class="formLeft">交易價格:</td><td class="formRight" >NT$ <input type="text" name="price" class="inputText" required></td>
									</tr>
                                    <tr>
                                    	<td class="formLeft">數量:</td><td class="formRight"><input type="number" name="quantity" class="inputNumber" min="1" required> 個</td>
                                    </tr>
									<tr>
										<td class="formLeft">原有損壞的地方:</td><td class="formRight"><textarea name="damaged_part" class="inputTextArea" placeholder="說明，描述"></textarea></td>
									</tr>
									<tr>
										<td class="formLeft">是否要配件才可使用:</td>
										<td class="formRight">
											<label><input type="radio" name="fitting" id="fitting1" value="否" onClick="chg2_1()" required>否</label><br/>
											<label><input  type="radio"  name="fitting" id="fitting2" value="是" onClick="chg2_2()" required>是</label><textarea name="fitting_yes" class="fitting_yes" id="fitting_yes" placeholder="配件是否加購，或是已經包含" readonly></textarea>
										</td>
									</tr>
									<tr>
										<td class="formLeft">加購配件:</td><td class="formRight"><input type="text" name="add_purchase" class="inputText"></td>
									</tr>
									<tr>
										<td class="formLeft" style="padding-right:25px;">物品圖片:</td>
										<td class="formRight">
											<input type="file" name="image" class="inputFile">
											<div>
												<img class="preview" style="max-width: 150px; max-height:150px">
												<div class="size"></div>
											</div>
										</td>
									</tr>
                                    <tr>
                                        <td class="formCenter" id="thisA" colspan="2">
                                            <input type="radio" name="protocol" required>
                                            同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                        </td>
                                    </tr>
								  </table>
								  <div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
							</form>
							</fieldset>
						</div>
				 		<div class="TabbedPanelsContent">
							<fieldset><h1 class="ThisH1">服務上架</h1><hr/>
							<form action="supply_service_insertdb.php" method="post" enctype="multipart/form-data">
								<table class="ThisTable2" border="0">
								<tr >
									<td class="formLeft">服務名稱:</td><td class="formRight"><input type="text" name="name" class="inputText" placeholder="ex:服務、代班" required></td>
								</tr>
								<tr>
                                    <td class="formLeft">類別:</td>
                                    <td class="formRight">
                                        <select name = "type2" class="inputSelect">
                                            <option value="bytime">按時算</option>
                                            <option value="bypic">按件算</option>
                                            <option value="other">其他</option>
                                        </select>
                                    </td>
                                </tr>
								<tr >
									<td class="formLeft">日期與時間:</td><td class="formRight"><input type="datetime-local" name="service_time" class="inputDatetime" required></td>
								</tr>
								<tr>
									<td class="formLeft">地點:</td><td class="formRight"><input type="text" name="location" class="inputText" required></td>
								</tr>
								
								<tr>
									<td class="formLeft">薪資計算:</td><td class="formRight"><input type="text" name="price" class="inputText" placeholder="按時、按件數" required></td>
								</tr>
								<tr>
									<td class="formLeft">工作內容:</td><td class="formRight"><textarea name="detail" class="inputTextArea" required></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">技能需求:</td><td class="formRight"><textarea name="need_skill" class="inputTextArea" placeholder="ex:Excel、程式、財務"></textarea></td>
								</tr>
								
								<tr>
									<td class="formLeft">特別需求:</td><td class="formRight"><textarea name="special" class="inputTextArea" placeholder="自帶電腦、身穿黑色衣褲"></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">需求人數:</td><td class="formRight"><input type="number" name="num_ppl" class="inputNumber" min="1" required> 人</td>
								</tr>
                                <tr>
                                    <td class="formCenter" id="thisA" colspan="2">
                                        <input type="radio" name="protocol" required>
                                        同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                    </td>
                                </tr>
								</table>
								<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
							</form>
							</fieldset>
						</div>
                        <div class="TabbedPanelsContent">
							<fieldset><h1 class="ThisH1">共乘上架</h1><hr/>
							<form action="supply_vehicle_insertdb.php" method="post" enctype="multipart/form-data">
								<table class="ThisTable3" border="0">
                                <tr>
                                    <td class="formLeft">類別:</td>
                                    <td class="formRight">
                                        <select name = "type2" class="inputSelect">
                                            <option value="car">汽車</option>
                                            <option value="motor">機車</option>
                                            <option value="other">其他</option>
                                        </select>
									</td>
                                </tr>
								<tr >
									<td class="formLeft">出發日期與時間:</td><td class="formRight"><input type="datetime-local" name="vehicle_date" class="inputDatetime" required></td>
								</tr>
								
								<tr>
									<td class="formLeft">目的地:</td><td class="formRight"><input type="text" name="destination" class="inputText" required></td>
								</tr>
								<tr>
									<td class="formLeft">集合地點:</td><td class="formRight"><textarea name="meet_place" class="inputTextArea" required></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">費用:</td><td class="formRight"><input type="text" name="price" class="inputText" placeholder="ex:300/人" required></td>
								</tr>
								
								<tr>
									<td class="formLeft">共乘人數:</td><td class="formRight"><input type="number" name="num_ppl" class="inputNumber" placeholder="乘客的人數" min="1" required> 人</td>
								</tr>
								<tr>
									<td class="formLeft">車子的款式:</td><td class="formRight"><textarea name="vehicle_brand" class="inputTextArea" placeholder="ex:豐田xx"></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">途徑的道路:</td><td class="formRight"><input type="text" name="road" class="inputText" placeholder="ex:國六/國一/台16"></td>
								</tr>
                                <tr>
                                    <td class="formLeft">是否接受中途下車:</td>
                                    <td class="formRight">
                                        <label><input type="radio" name="mid_getoff" id="mid1" onClick="chg4_1()" value="否">否</label><br/>
                                        <label><input type="radio"  name="mid_getoff" id="mid2" value="是" onClick="chg4_2()" required>是</label><textarea name="mid_yes" class="mid_yes" id="mid_yes" placeholder="ex:去彰化的車，可以在台中下車" readonly></textarea>
                                    </td>
								</tr>
                                
                                <tr>
									<td class="formLeft">備註:</td><td class="formRight"><textarea name="remind" class="inputTextArea" ></textarea></td>
								</tr>
                                <tr>
                                    <td class="formCenter" id="thisA" colspan="2">
                                        <input type="radio" name="protocol" required>
                                        同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                    </td>
                                </tr>
								</table>
								<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
							</form>
							</fieldset>
						</div>
						<div class="TabbedPanelsContent">
							<fieldset><h1 class="ThisH1">空間上架</h1><hr/>
							<form  action="supply_space_insertdb.php" method="post" enctype="multipart/form-data">
								<table class="ThisTable4" border="0">
								<tr >
									<td class="formLeft">空間名稱:</td><td class="formRight"><input type="text" name="name" class="inputText" placeholder="ex:小型開會空間" required></td>
								</tr>
								<tr>
                                    <td class="formLeft">類別:</td>
                                    <td class="formRight">
                                        <select name = "type2" class="inputSelect">
                                            <option value="stay">住宿</option>
                                            <option value="store">儲藏</option>
                                            <option value="other">其他</option>
                                        </select>
									</td>
                                </tr>
								<tr >
									<td class="formLeft">地點:</td><td class="formRight"><input type="text" name="location" class="inputText" placeholder="ex:管院 R103" required></td>
								</tr>
								
								<tr>
									<td class="formLeft">大小:</td><td class="formRight"><textarea name="size" style="padding-bottom:15px;" class="inputTextArea" placeholder="說明，坪數、大小、或以人數容量概估，ex：4坪、可容納4人" required></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">建議使用人數:</td><td class="formRight"><input type="text" name="num_ppl" class="inputText" placeholder="ex:3~5人" required></td>
								</tr>
								<tr>
									<td class="formLeft">價格:</td><td class="formRight"><input type="text" name="price" class="inputText" placeholder="ex:以天計算、以時計算" required></td>
								</tr>
								<tr>
									<td class="formLeft">使用期限:</td>
									<td class="formRight">
										開始：<input type="date" class="inputDate" name="d_start" required><br/>
										結束：<input type="date" class="inputDate" name="d_stop" required>
									</td>
								</tr>
								
								<tr>
									<td class="formLeft">空間內設備:</td>
									<td class="formRight">
										<label><input type="checkbox" name="facilities[]" value="電視" required>電視</label>
										<label><input type="checkbox" name="facilities[]" value="電腦" required>電腦</label>
										<label><input type="checkbox" name="facilities[]" value="投影機" required>投影機</label><br/>
										<label><input type="checkbox" name="facilities[]" value="印表機" required>印表機</label>
										<label><input type="checkbox" name="facilities[]" value="冷氣" required>冷氣</label>
										<label><input type="checkbox" name="facilities[]" value="電風扇" required>電風扇</label><br/>
										<label><input type="checkbox" name="facilities[]" value="冰箱" required>冰箱</label>
										<label><input type="checkbox" name="facilities[]" value="儲物櫃" required>儲物櫃</label>
										<label><input type="checkbox" name="facilities[]" value="網絡" required>網絡</label><br/>
										<label><input type="checkbox" name="facilities[]" value="桌子" required>桌子</label>
										<label><input type="checkbox" name="facilities[]" value="室內廁所" required>椅子</label><br/>
										<label><input type="checkbox" name="facilities[]" id="facilities" value="其他" onClick="Schg2()" required>其他:</label><textarea name="fac_oth" class="fac_oth" id="fac_oth" cols="50" rows="1" readonly></textarea>
									</td>
								</tr>
								<tr>
									<td class="formLeft">附設設備收費:</td><td class="formRight"><textarea name="fac_with" class="inputTextArea" placeholder="ex:冷氣(NT$5/per hour)"></textarea></td>
								</tr>
								<tr>
									<td class="formLeft">空間圖片:</td>
									<td class="formRight">
										<input type="file" name="image" class="inputFile">
										<div>
											<img class="preview" style="max-width: 150px; max-height:150px">
											<div class="size"></div>
										</div>
									</td>
								</tr>
                                <tr>
                                    <td class="formCenter" id="thisA" colspan="2">
                                        <input type="radio" name="protocol" required>
                                        同意我們的<a href="apply_protocol.php" target="_blank">商品及服務上架政策</a>與<a href="noLiability_protocol.php" target="_black">免責協議</a>
                                    </td>
                                </tr>
								</table>
								<div class="BTN"><input type="submit" class="buttonType" value="確定送出"></div>
							</form>
							</fieldset>
						</div>
					</div>
				</div>-->
		<?php
        	echo "<div id='this_footer'>";
			require ("footer.php");
        	echo "</div>";
        	
			}
		?>
	</div>
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="js/script-scroll.js"></script>
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
    <script>
		$(function(){
			var requiredCheckboxes = $(':checkbox[required]');
		    requiredCheckboxes.change(function(){
				if(requiredCheckboxes.is(':checked')) {
					requiredCheckboxes.removeAttr('required');
				}
				else {
					requiredCheckboxes.attr('required', 'required');
				}
			});
		});
	</script>
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
    <script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.toast.js"></script>
    </body>
</html>