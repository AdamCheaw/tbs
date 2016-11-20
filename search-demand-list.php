<link rel="stylesheet" href="css/supply-list-style.css" type="text/css"/>
<?php
session_start();
require ("connMysql.php");
?>
<?php
	$title = $_POST['title'];
	if($title)
	{
		$sql_query = "select * from supply_goods_list where name like'%$title%'";
		$result = mysqli_query($db_conn,$sql_query);
		$goods_num = mysqli_num_rows($result);
		$sql_query2 = "select * from supply_service_list where name like'%$title%'";
		$result = mysqli_query($db_conn,$sql_query2);
		$service_num = mysqli_num_rows($result);
		$sql_query3 = "select * from supply_space_list where name like'%$title%'";
		$result = mysqli_query($db_conn,$sql_query3);
		$space_num = mysqli_num_rows($result);
		if($goods_num > 0 || $service_num > 0 || $space_num > 0)
		{
			require ("apply-and-list.php");
		}
		else
		{
			require ("apply.php");
		}
	}
	else
	{
		require ("apply.php");
	}
?>