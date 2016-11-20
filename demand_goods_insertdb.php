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

$type = "goods"; 
$provider = $_SESSION['user_id'];
$need_date = mysqli_real_escape_string($db_conn,$_POST['need_date']);
$need_date = strtotime($need_date);
$date_new = date("Y-m-d",$need_date);
$name = mysqli_real_escape_string($db_conn,$_POST['name']);


$brand = mysqli_real_escape_string($db_conn,$_POST['brand']);

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
$price = mysqli_real_escape_string($db_conn,$_POST['price']);

$description = mysqli_real_escape_string($db_conn,$_POST['description']);

date_default_timezone_set('Asia/Taipei');
$post_date = date("Y-m-d H:i:s");

if($name){ 
	$sql = "insert into demand_list(type, name, brand, image, price, description, provider, post_date, d_status, need_date) values ('$type', '$name', '$brand', '$image', '$price', '$description', '$provider', '$post_date', 'on', '$date_new');";
	mysqli_query($db_conn,$sql) or die("MySQL insert DATA error");
	$_SESSION['insertDB'] = 1;
	header("Location:demand_apply.php");
}else{
	$_SESSION['noInsertDB'] = 1;
	header("Location:demand_apply.php");
}
?>