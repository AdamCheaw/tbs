<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("connMysql.php");
$sql_query = "select * from user_list where uid='".$_POST['id']."';";
$result = mysqli_query($db_conn,$sql_query);
$row = mysqli_fetch_array($result);
$id = $_POST['id'];
$nickname = $_POST['nickname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$birthday = $_POST['birthday'];
$f_name = $_FILES['image']['name'];
$f_tmp_name = $_FILES['image']['tmp_name'];
$f_type = $_FILES['image']['type'];
$f_size = $_FILES['image']['size'];
$image = $row["picture"];
$introduce = $_POST["introduce"];
$school = $_POST["school"];
$work = $_POST["work"];
    if($f_size > 0){
		if(file_exists("uploadfile/".$f_name)){
			$file = explode(".",$f_name);
			$file2 = explode("/",$f_type);
			$f_new_name = $file[0]."-".date("ymdhis")."-".rand(0,10).".".$file2[1];
			echo "<br/>檔名重複，修改新檔名為：".$f_new_name."<br/>圖檔上傳成功<br/>";
			move_uploaded_file($f_tmp_name,"uploadfile/".$f_new_name);
			$img = $row["picture"];
			unlink($img);
			$image = 'uploadfile/'.$f_new_name;
		}else{
			move_uploaded_file($f_tmp_name,"uploadfile/".$f_name);
			echo "圖片上傳成功<br/>";
			$image = 'uploadfile/'.$f_name;
			$img = $row["picture"];
			unlink($img);
		}
	}
date_default_timezone_set('Asia/Taipei');
$update_date = date("Y-m-d H:i:s");
	
$sql = "update user_list set nickname='$nickname', email='$email', birthday='$birthday', phone='$phone',picture='$image',introduce='$introduce',
        work='$work', school='$school', update_date='$update_date' where uid='".$id."'";
if(mysqli_query($db_conn,$sql))
{
	echo '<meta http-equiv=REFRESH CONTENT=2;url=user-edit.php>';
}
else
{
	echo "<script>alert('修改失敗');</script>";
	echo '<meta http-equiv=REFRESH CONTENT=2;url=user-edit.php>';
}
?>