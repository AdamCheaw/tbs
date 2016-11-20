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

$type = "space";
$type2 = mysqli_real_escape_string($db_conn,$_POST['type2']);
$provider = $_SESSION['user_id'];
$name = mysqli_real_escape_string($db_conn,$_POST['name']);
$location = mysqli_real_escape_string($db_conn,$_POST['location']);
$space_size = mysqli_real_escape_string($db_conn,$_POST['size']);
$price = mysqli_real_escape_string($db_conn,$_POST['price']);
$num_ppl = mysqli_real_escape_string($db_conn,$_POST['num_ppl']);
$start = mysqli_real_escape_string($db_conn,$_POST['d_start']);
$time = strtotime($start);
$start_new = date("Y-m-d",$time);
$stop = mysqli_real_escape_string($db_conn,$_POST['d_stop']);
$time2 = strtotime($stop);
$stop_new = date("Y-m-d",$time2);
if(!empty($_POST['facilities'])){
	$fac_new = "";
	foreach($_POST['facilities'] as $fac){
		$fac_new .= $fac." ";
	}
}
$fac_oth = mysqli_real_escape_string($db_conn,$_POST['fac_oth']);
$fac_oth_new = $fac_new.$fac_oth;
$fac_with = mysqli_real_escape_string($db_conn,$_POST['fac_with']);
//取得上傳檔案資訊
	$f_name = $_FILES['image']['name'];
    $f_tmp_name = $_FILES['image']['tmp_name'];
    $f_type = $_FILES['image']['type'];
    $f_size = $_FILES['image']['size'];

    if($f_size > 0){
		if(file_exists("uploadfile/".$f_name)){
			$file = explode(".",$f_name);
			$file2 = explode("/",$f_type);
			$f_new_name = $file[0]."-".date("ymdhis")."-".rand(0,10).".".$file2[1];
			echo "<br/>檔名重複，修改新檔名為：".$f_new_name."<br/>圖檔上傳成功<br/>";
			move_uploaded_file($f_tmp_name,"uploadfile/".$f_new_name);
			$image = 'uploadfile/'.$f_new_name;
		}else{
			move_uploaded_file($f_tmp_name,"uploadfile/".$f_name);
			echo "圖片上傳成功<br/>";
			$image = 'uploadfile/'.$f_name;
		}
	}else{
		$image = 'uploadfile/itemicon.png';	
	}
date_default_timezone_set('Asia/Taipei');
$post_date = date("Y-m-d H:i:s");

if($name){
	$sql = "insert into supply_space_list(type, type2, name, location, space_size, num_ppl, price, space_start, space_stop, facilities, fac_with, image, post_date, provider) values ('$type', '$type2', '$name', '$location', '$space_size', '$num_ppl', '$price', '$start_new', '$stop_new', '$fac_oth_new', '$fac_with', '$image', '$post_date', '$provider')";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	
	$sql_query = "select * from supply_space_list where provider='".$provider."' and post_date='".$post_date."';";
	$result = mysqli_query($db_conn,$sql_query);
	$row = mysqli_fetch_array($result);
	$s_type = $row['type'];
	$s_type2 = $row['type2'];
	$s_id = $row['id'];
	$s_name = $row['name'];
	$sql_sl = "insert into supply_list(s_type, s_type2, s_id, s_name, s_status) values ('$s_type', '$s_type2,', '$s_id', '$s_name', 'on')";
	mysqli_query($db_conn,$sql_sl) or die("MySQL insert_sl DATA error");
	
	$_SESSION['insertDB'] = 1;
	header("Location:supply_apply.php");
}else{
	$_SESSION['noInsertDB'] = 1;
	header("Location:supply_apply.php");
}
?>