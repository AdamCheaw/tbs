<?php
require ("connMysql.php");
session_start();

$id=(int)$_GET['id'];
$type = $_GET['type'];
$email = $_GET['email'];
if($id<=0){
	echo "empty ID";
	exit(0);
}
$message_uid = $_SESSION['user_id'];
$message_content = mysqli_real_escape_string($db_conn,$_POST['message_content']);
date_default_timezone_set('Asia/Taipei');
$message_date = date("Y-m-d H:i:s");
if($id){
	$sql = "insert into user_message (s_type, supply, message_date, message_uid, message_content) values ('$type', '$id', '$message_date', '$message_uid', '$message_content')";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	/*Send Email
		$to      = $email;
		$subject = " TBS.com";
		$message = "親愛的，您的產品有新的留言。";
		$headers =	'From: noreply@ TBS.com' . "\r\n" . 
					'Reply-To: noreply@ TBS.com' . "\r\n" .  
		   			'X-Mailer: PHP/' . phpversion();  
		mail($to, $subject, $message, $headers);*/
	echo "<script>";
	echo "history.go(-1)";
	echo "</script>";
}
?>