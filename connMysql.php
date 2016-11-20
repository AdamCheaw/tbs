<?php
$db_host = "localhost";
$db_username = "tbsadmin";
$db_password = "ncnu102213";
$db_name = "tbs";
$db_conn = mysqli_connect($db_host,$db_username,$db_password,$db_name) or die("Could not connect!");
mysqli_query($db_conn, "SET NAMES 'utf8'"); //設定編碼	
?>