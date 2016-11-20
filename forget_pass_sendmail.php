<?php
require("connMysql.php");
session_start();
function checkInput($value){
	if(get_magic_quotes_gpc()){
		$value = stripslashes($value);
	}
	if(!is_numeric($value)){
	  $value = mysql_real_escape_string($value);
	}
	return $value;
}

$email = mysqli_real_escape_string($db_conn,$_POST['email']);

$sql_query = "select * from user_list where email='".$email."'";
$result = mysqli_query($db_conn,$sql_query);
$row = mysqli_fetch_array($result);
if($row["email"] != $email ){
	$_SESSION['unRegisterEmail'] = 1;
	header("Location: forget_pass_page.php");
}else {
	$sql_query2 = "select * from user_list where email='".$email."'";
	$result2 = mysqli_query($db_conn,$sql_query2);
	$row2 = mysqli_fetch_array($result2);
	$token = md5($row2['uid'].$row2['username'].$row2['password']);
	date_default_timezone_set('Asia/Taipei');
	$sendtime = date('Y-m-d H:i');
		##Send Email
		$to      = $_POST['email'];
		$subject = " TBS.com Forget Password";
		$message = "親愛的 ".$row2['username']."：\n您在 ".$sendtime." 提交了找回密碼請求。\n請點擊鏈接重置密碼。\nhttp://localhost/tbs/test0815/forget_pass_reset.php?email=".$email."&token=".$token."\n如果以上鏈接無法點擊，請將它複製到您的瀏覽器地址欄中進入訪問。"; 
		$headers = 'From: noreply@ TBS.com' . "\r\n" .  
		   			'Reply-To: noreply@ TBS.com' . "\r\n" .  
		   			'X-Mailer: PHP/' . phpversion();  
		mail($to, $subject, $message, $headers);
?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>TbS</title>
		<link rel="shortcut icon" href="img/favicon.ico" />
		 <link href="css/register_page.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div id="wrapper">
			<div id="header">
				<div id="header-inner">
					<div id="logo">
						<a href="demand.php"><img src="img/logo.png" /></a>
					</div>
				</div>
			</div>
			<div id="content">
				<div id="regSuccess">
					系統已向您的郵箱發送一封郵件。<br/>请登录到您的邮箱及时重置您的密碼！<br/><br/>
					<div id="thisBtn"><a href="demand.php">點我～回到首頁</a></div>
				</div>
			</div>
		</div>
	</body>
	</html>
<?php
}
?>