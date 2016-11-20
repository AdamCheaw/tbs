<?php
session_start();
require("connMysql.php");
require ("connFB.php");
 
$helper = $fb->getRedirectLoginHelper();
try {
	$accessToken = $helper->getAccessToken();
} 
catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	//echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} 
catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	//echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}
 
/*if (! isset($accessToken)) {
	if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    //echo "Error: " . $helper->getError() . "\n";
    //echo "Error Code: " . $helper->getErrorCode() . "\n";
    //echo "Error Reason: " . $helper->getErrorReason() . "\n";
    //echo "Error Description: " . $helper->getErrorDescription() . "\n";
	} else {
    	header('HTTP/1.0 400 Bad Request');
    	//echo 'Bad request';
  	}
  	exit;
}
 
// Logged in
//echo '<h3>Access Token</h3>';
var_dump($accessToken->getValue());//取得Token
 
// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();
 
// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
var_dump($tokenMetadata);
 
// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId('500571860138545');//app_id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();
 
if (! $accessToken->isLongLived()) {
	// Exchanges a short-lived access token for a long-lived one
	try {
    	$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);//取得長期Token
	} 
	catch (Facebook\Exceptions\FacebookSDKException $e) {
    	//echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
    	exit;
  	}
 
	//echo '<h3>Long-lived</h3>';
	var_dump($accessToken->getValue());
	$ab=$accessToken->getValue();
}*/

$_SESSION['fb_access_token'] = (string) $accessToken; //將Token寫入session裡 

if(isset($_SESSION['fb_access_token'])){
	try {
		//Returns a `Facebook\FacebookResponse` object
		$response = $fb->get('/me?fields=id,name,gender,picture', $_SESSION['fb_access_token']);
		//取得登入者的 id,name,email(若fb使用者本身的mail未認證即取不到此值，即便有取得該使用者的mail權限)
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
	  //echo 'Graph returned an error: ' . $e->getMessage();
	  exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  //echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  exit;
	}
}
$user = $response->getGraphUser();
$_SESSION['FBuid'] = $user['id'];
$_SESSION['FBname'] = $user['name'];
$_SESSION['FBgender'] = $user['gender'];
$_SESSION['FBpicture'] = "http://graph.facebook.com/".$_SESSION['FBuid']."/picture?type=normal";

$sql_query = "select * from user_list where FBuid ='".$_SESSION['FBuid']."'";
$result = mysqli_query($db_conn,$sql_query);
$row = mysqli_fetch_array($result);
if($row["FBuid"] == $_SESSION['FBuid']){
	$_SESSION['user_id'] = $row["uid"];
	$_SESSION['login'] = 1;
	echo "<script> history.go(-1) </script>";
}else{
	header('Location: fb_register.php');	
}
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
?>