<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/13/2016 013
 * Time: 12:42 AM
 */


/**
 * Session
 * position
 */
session_start();

$uri = explode("/", $_SERVER['REQUEST_URI']);
if($uri[1] == "") {

    if(isset($_SESSION['user_id'])) {
        require "view/view_home.php";
    }
    else {
        require "view/view_login.php";
    }

}
else if($uri[1] == "rooms") {
    require "view/view_home.php";
}
else if($uri[1] == "chat") {
    require "process/chat.php";
}
else if($uri[1] == "login") {
    require "process/login_naver.php";
}

else if($uri[1] == "logincbu") {
    require "process/login_complete.php";
}

else if($uri[1] == "logout") {
    require "process/logout.php";
}