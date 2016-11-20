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

$username = mysqli_real_escape_string($db_conn,$_POST['username']);
$nickname = mysqli_real_escape_string($db_conn,$_POST['nickname']);
$phone = mysqli_real_escape_string($db_conn,$_POST['phone']);
$email = mysqli_real_escape_string($db_conn,$_POST['email']);
$password = mysqli_real_escape_string($db_conn,$_POST['password']);
$password2 = mysqli_real_escape_string($db_conn,$_POST['password2']);
$birthday = mysqli_real_escape_string($db_conn,$_POST['birthday']);
$gender = mysqli_real_escape_string($db_conn,$_POST['gender']);
$picture = 'img/selfie.png';
date_default_timezone_set('Asia/Taipei');
$register_date = date("Y-m-d H:i:s");

$sql_query = "select * from user_list where email ='".$email."'";
$result = mysqli_query($db_conn,$sql_query);
$row = mysqli_fetch_array($result);
if($row["email"] == $email){
	$_SESSION['registerEmail'] = 1;
	header("Location: register_page.php");
}
else if($password != $password2){
	$_SESSION['registerPwd'] = 1;
	header("Location: register_page.php");
}
else if($row["email"] != $email && $password == $password2){
	$token = md5($username.$password.mt_rand());
	$sql = "insert into user_list(username, nickname, phone, email, password, birthday, picture, gender, token, status, register_date) values ('$username', '$nickname', '$phone', '$email', '$password', '$birthday', '$picture', '$gender', '$token', 'unActive', '$register_date')";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
		##Send activation Email
		$to      = $_POST['email'];
		$subject = " TBS.com Registration";
		$message = "親愛的 ".$username."：\n感謝您在我們的網站註冊了新帳號。\n請點擊鏈接激活您的賬號。\nhttp://localhost/tbs/test0813/register_active.php?verify=".$token."\n如果以上鏈接無法點擊，請將它複製到您的瀏覽器地址欄中進入訪問。"; 
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
					恭喜您，注册成功！<br/>请登录到您的邮箱及时激活您的賬號！<br/><br/>
					<div id="thisBtn"><a href="demand.php">點我～回到首頁</a></div>
				</div>
			</div>
		</div>
	</body>
	</html>
<?php
}
?>