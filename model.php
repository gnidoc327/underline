<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2/13/2016 013
 * Time: 12:42 AM
 */

//namespace model;




class Model
{
    /**
     * static
     * @var null
     */
    public static $instance = null;
    public static $pdo = null;


    private $hostname = '52.79.85.40';
    private $dbname = 'underline';
    private $username = 'root';
    private $userpasswd = 'root';


    private function __construct()
    {
        try {
            static::$pdo
                //= new PDO("mysql:host= $this->hostname;dbname=$this->dbname",$this->username,$this->userpasswd);
                = new PDO('mysql:host=localhost;dbname=underline', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function initiate()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    public static function temp()
    {
        echo 4;
    }


    public static function insert_user($name)
    {
        $stmt = static::$pdo->prepare("INSERT INTO user (name) VALUES (:name)");

        $stmt->execute(array(
            "name" => $name
        ));
        return true;
    }

    public static function insert_room($room_id, $name, $image_link)
    {
        $stmt = static::$pdo->prepare("INSERT INTO user (room_id, name, image_link) VALUES (:id, :name, :link)");

        $stmt->execute(array(
            "id" => $room_id,
            "name" => $name,
            "link" => $image_link
        ));
        return true;
    }

    public static function insert_user_to_room($user_id, $room_id)
    {
        $stmt = static::$pdo->prepare("INSERT INTO user_room(user_id, room_id) VALUES (:user, :room)");

        $stmt->execute(array(
            "user" => $user_id,
            "room" => $room_id
        ));
    }

    public static function get_all_user()
    {
        $stmt = static::$pdo->prepare("SELECT user_id FROM user");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function get_rooms($userid)
    {
        $stmt = static::$pdo->prepare("SELECT room_id FROM chat WHERE user_id = :user");
        $stmt->bindParam(':user', $userid);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function get_all_room()
    {
        $stmt = static::$pdo->prepare("SELECT room_id ,name FROM room");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function get_users()
    {
        $stmt = static::$pdo->prepare("SELECT * FROM user");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public static function insert_into_chat($user_id, $room_id, $msg) {
        $stmt = static::$pdo->prepare("INSERT INTO chat(user_id, room_id, msg) VALUES (:user, :room, :m)");

        $stmt->execute(array(
            "user" => $user_id,
            "room" => $room_id,
            "m" => $msg
        ));
    }


    public function isvaildated_account($name){
        $stmt = static::$pdo->prepare("SELECT name FROM user WHERE :name= name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($result == NULL){
            return false;
        } else {
            return true;
        }
    }

    public function get_recent_chat($roomid){
        $stmt = static::$pdo->prepare("SELECT msg, user_id FROM chat WHERE room_id=:room");
        $stmt->execute(array(
            "room" => $roomid
        ));
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

    }

}

Model::initiate();








