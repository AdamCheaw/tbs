<?php
include ("connMysql.php");//连接数据库 
session_start();

$verify = stripslashes(trim($_GET['verify']));
$sql_query = "select * from user_list";
$result = mysqli_query($db_conn,$sql_query);
while($row = mysqli_fetch_array($result)){
	if($row['status'] == 'unActive'){
		$sql_query2 = "select * from user_list where token='".$verify."' and status='unActive' ";
		$result2 = mysqli_query($db_conn,$sql_query2);
		while($row2 = mysqli_fetch_array($result2)){
			$sql = "update user_list set token='', status='active' where uid='".$row2['uid']."'";
			mysqli_query($db_conn,$sql) or die("MySQL update DATA error");
			$_SESSION['user_id'] = $row2["uid"];
			$_SESSION['actived'] = 1;
			header ("Location: demand.php");
		}
	}else{
		$_SESSION['adyActive'] =1;
		header ("Location: demand.php");
	}
} 
?>