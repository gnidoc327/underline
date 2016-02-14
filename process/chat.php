<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/14/2016 014
 * Time: 2:05 AM
 */

$return = 1;



if($_POST['type'] == "send") {

    /**
     * mock.
     */
    $user_id = $_SESSION['user_id'];
    $room_id = $_SESSION['room_id'];
    $msg = $_POST['msg'];
    echo $msg;
    Model::insert_into_chat($user_id, $room_id, $msg);
}

else if($_POST['type'] == "receive") {
    $room_id = $_SESSION['room_id'];
    $result = Model::get_recent_chat($room_id);
    if(!isset($result)){
        echo json_encode("data가 없습니다");
    }else {
        $output = json_encode($result);
    }
    echo $output;
}

else if($_POST['type'] == "enter"){
    $_SESSION['room_id'] = $_POST['room_id'];
}
