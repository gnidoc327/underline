<?php
require '/var/www/html/assets/lib/class.naverOAuth.php';
require '/var/www/html/model.php';

$request = new OAuthRequest( 'YfSwfgt0KvjI2pEWo0X4', 'chDpyBDxVF','http://underline.malmoym.com/process/login_complete.php');
$request -> call_accesstoken();
$request -> get_user_profile();

$temp = $request->get_userID();
//echo "$temp";
if(!Model::isvaildated_account($temp)) {

    Model::insert_user($temp);
}

$_SESSION["user_id"] = $temp;;

echo "<meta http-equiv='refresh' content='0; url=http://underline.malmoym.com/'>";
?>