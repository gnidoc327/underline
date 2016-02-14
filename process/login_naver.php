<?php
require '/var/www/html/assets/lib/class.naverOAuth.php';


$request = new OAuthRequest( 'YfSwfgt0KvjI2pEWo0X4', 'chDpyBDxVF', 'http://underline.malmoym.com/process/login_complete.php');
$request -> set_state();
$request -> request_auth();


?>
