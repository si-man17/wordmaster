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
    private static $instance = null;

    public static function getInstance($data = []){
        $res = null;
        if (!self::$instance) $res = new self($data);
        else $res = self::$instance;
        return $res;
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
    }

    public static function insertUser($data){
        $new_user = new self($data);
        $db = Db::getInstance();
        $db->exec("INSERT INTO users (`name`, surname, email, `password`, is_admin) values(:n, :s, :e, :p, '0')", 
            ['n' => $new_user->name, 's' => $new_user->surname, 'e' => $new_user->email, 'p' => self::getPasswordHash($new_user->password)]);
        return true;
    }

    private static function getPasswordHash($pswd){
        return md5($pswd . 'hyi_vragam_Kubani');
    }

    public static function checkUserExist($data){   
        $db = Db::getInstance();
        $dat = $db->fetchAll("SELECT * FROM users WHERE  email =:e and is_admin=0", [ 'e' => $data['email']]);
        if (empty($dat)) return false;
        else return true;
        
    }
}