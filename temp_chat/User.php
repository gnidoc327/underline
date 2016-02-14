<?php
/**
 * Created by PhpStorm.
 * User: shinhyungjune
 * Date: 2016. 2. 14.
 * Time: 오전 12:21
 */

namespace User;


public class User
{
    private $user_id;
    private $user_name;
    private $rooms = array();

    public function __construct($user_id, $user_name, $rooms){
        $this->$user_id = $user_id;
        $this->$user_name = $user_name;
        $this->$rooms = $rooms;
    }
    public function get_user_id(){
        return $this->$user_id;
    }
    public function get_user_name(){
        return $this->$user_name;
    }
    public function get_rooms(){
        return $this->$rooms;
    }
}