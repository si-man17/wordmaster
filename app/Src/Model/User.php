<?php

namespace App\Src\Model;
use App\Core\Db;
use App\Core\Request;

class User{
    public $id;
    public $name;
    public $surname;
    public $email;
    protected $password;
    public $is_admin;
    private static $instance = null;

    public static function getInstance($data = []){
        $res = null;
        if (!self::$instance) $res = new self($data);
        else $res = self::$instance;
        return $res;
    }

    public static function getUserById($id){
        $db = Db::getInstance();
        $dat = $db->fetchOne("SELECT * FROM users WHERE id=:id", ['id' => $id]);
        return new self($dat);
    }

    public static function checkUserIsset($data){
        if (empty($data)) return null;
    }

    public static function isLoggin(){
        if (!empty($_SESSION['user_id'])) return 1;
        return false;
    }


    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }
    private function __clone(){}

    private function __construct($data = []){
        if (!empty($data['id'])) $this->id = (int)$data['id'];
        $this->name = $data["name"];
        $this->surname = $data['surname'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->is_admin = 0;
        if (isset($data['is_admin']) && (int)$data['is_admin'] == 1) $this->is_admin = 1;
    }

    public static function insertUser($data){
        $new_user = new self($data);
        $db = Db::getInstance();
        $db->exec("INSERT INTO users (`name`, surname, email, `password`, is_admin) values(:n, :s, :e, :p, '0')", 
            ['n' => $new_user->name, 's' => $new_user->surname, 'e' => $new_user->email, 'p' => self::getPasswordHash($new_user->password)]);
        return true;
    }

    public static function getPasswordHash($pswd){
        return md5($pswd . 'hyi_vragam_Kubani');
    }

    public static function checkUserExist($data){   
        $db = Db::getInstance();
        $dat = $db->fetchAll("SELECT * FROM users WHERE  email =:e and is_admin=0", [ 'e' => $data['email']]);
        if (empty($dat)) return false;
        else return true;
    }
    
    public static function loginAuth($data){
        $db = Db::getInstance();
        $pswd = self::getPasswordHash($data['password']);
        $email = $data['email'];
        $dat = $db->fetchOne('SELECT * FROM users WHERE email=:email and `password`=:p', ['email'=> $email, 'p' => $pswd]); 
        if (empty($dat)) return false;
        else {
            $_SESSION['user_id'] = (int)$dat['id'];
            $_SESSION['user_name'] = $dat['name'] . ' ' . $dat['surname'];
            $_SESSION['is_admin'] = (int)$dat['is_admin'];
            $_SESSION['login_time'] = time();
            return new self($dat);
        }
    }
}