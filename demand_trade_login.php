<?php
require ("connMysql.php");
require ("connFB.php");
session_start();

$id=(int)$_GET['id'];
$provider = $_GET['provider'];
if(isset($_SESSION['user_id'])){
	unset($_SESSION['login']);
	$sql = "select * from demand_list where id='".$id."' ";
	$result = mysqli_query($db_conn,$sql);
	while($row = mysqli_fetch_array($result)){
		if($row['d_status'] == 'down'){
			$_SESSION["demandDown"] =1;
			header ("Location: demand_list.php");
		}else{
			$type = $row['type'];
			header("Location: demand_trade_confirm.php?id=$id&provider=$provider&type=$type");
		}
	}	
}else{
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>TbS</title>
		<link rel="shortcut icon" href="img/favicon.ico" />
		<link href="css/login_page.css" rel="stylesheet" type="text/css"/>
        <link type="text/css" rel="stylesheet" href="css/jquery.toast.css">
	</head>
	<body>
		<div id="f_wrapper">
			<div id="f_header">
				<div id="f_header-inner">
					<div id="f_logo">
						<a href="demand.php"><img src="img/logo.png" /></a>
					</div>
				</div>
			</div>
			<div id="f_content">
				<div id="bck-img"><img src="img/bike.jpg"></div>
				<div id="login-form">
					<table border="0">
					<form action="login.php" method="post" enctype="multipart/form-data">
						  <tr>
							<td class="thisTitle" colspan="2"><h1>賬戶登入</h1><hr/></td>
						  </tr>
						  <tr>
							<td>賬號：</td><td><input type="text" name="email" class="inputText" placeholder="s123456789@ncnu.edu.tw" required/></td>
						  </tr>
						  <tr>
							<td>密碼：</td><td><input type="password" name="password" class="inputText" required></td>
						  </tr>
						  <tr>
							<td colspan="2"><input type="submit" class="ubutton" value="登入"></td>
						  </tr>
					  </form>
						  <tr>
							<td colspan="2" id="thisSub"><div class="subTitle"><a href="register_page.php">賬戶註冊</a></div><div class="subTitle"><a href="forget_pass_page.php">忘記密碼?</a></div></td>
						  </tr>
						  <tr>
							<td colspan="2"><div id="thisOr">———————— OR ————————</div></td>
						  </tr>
						  <tr>
							<td colspan="2">
							<?php
								$helper = $fb->getRedirectLoginHelper();
								$permissions = ['user_likes']; // 要取得的權限
								$loginUrl = $helper->getLoginUrl('http://localhost/tbs/test0822/login-callback.php', $permissions);//取得權限後要跳轉的頁面
	
								echo '<div id="thisFBbtn"><a href="'.$loginUrl.'">Log in with Facebook!</a></div>';
							?>
							</td>
						  </tr>
					 </table>
			  </div>
			</div>
			<div id="thisFooter">
				<?php require ("footer.php")?>
			</div>
		</div>
        <script src="http://libs.useso.com/js/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="js/jquery.toast.js"></script>
        <?php
			if(isset ($_SESSION['unLogin'])){
				unset($_SESSION['unLogin']);	
		?>
			<script type="text/javascript">
				function Toast(){
					$.toast({
						text: "登入失敗，請確認帳密", // Text that is to be shown in the toast
						heading: 'Login', // Optional heading to be shown on the toast
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
		<?php } ?>
        <?php
        	if(isset ($_SESSION['unActive'])){
			unset($_SESSION['unActive']);
		?>
        	<script type="text/javascript">
				function Toast(){
					$.toast({
						text: "賬號還未激活，請前往您的郵箱激活", // Text that is to be shown in the toast
						heading: '', // Optional heading to be shown on the toast
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
		<?php } ?>
	</body>
	</html>
<?php
    }
?>