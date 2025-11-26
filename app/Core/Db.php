<?php

namespace App\Core;

use App\Core\Config;
use PDOException;

class Db{

    private $pdo;
    private $log;
    private static $instance;
    public static $count = 0;

    private function __construct(){
        
    }

    private function __clone(){

    }

    public static function escare($data){ 
        $dat = self::getInstance()->getConnect(); 
        return $dat->quote($data);
    }

    public function __wakeup() {
        throw new \Exception("Cannot unserialize singleton");
    }

    public static function getInstance(){ 
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function exec($query_str, $params, $method = ''){

        $this->getInstance()->getConnect();
        $t = microtime(1);
        $query = $this->pdo->prepare($query_str); 
        $res = $query->execute($params);
        $t = microtime(1) - $t; 

        if (!$res){
            if ($query->errorCode()){
                trigger_error(json_encode($query->errorInfo()));
            }
            return false;
        }

        $this->log[] = [
            "query" => $query,
            "time" => $t,
            "method" => $method
        ];

        return $query->rowCount();
    }

    public function fetchAll(string $query, array $params = [], string $method = ""){
        $this->getInstance()->getConnect();
        $t = microtime(1);
        $query = $this->pdo->prepare($query);
        $res = $query->execute($params);
        $t = microtime(1) - $t; 

        if (!$res){
            if ($query->errorCode()){
                trigger_error(json_encode($query->errorInfo()));
            }
            return false;
        }

        $this->log[] = [
            "query" => $query,
            "time" => $t,
            "method" => $method
        ];

        return $query->fetchAll($this->pdo::FETCH_ASSOC);
    }

    public function fetchOne(string $query, array $params = [], string $method = ""){
        $this->getInstance()->getConnect();
        $t = microtime(1);
        $query = $this->pdo->prepare($query);
        $res = $query->execute($params);
        $t = microtime(1) - $t; 

        if (!$res){
            if ($query->errorCode()){
                trigger_error(json_encode($query->errorInfo()));
            }
            return false;
        }

        $this->log[] = [
            "query" => $query,
            "time" => $t,
            "method" => $method
        ];

        $result = $query->fetchAll($this->pdo::FETCH_ASSOC);
        return reset($result);
    }

    private function getConnect(){
        $data = Config::getDBdataConnect();

        if (!$this->pdo){
            try{
                $user = $data['user_name'];
                $pswd = $data['password']; 

                $this->pdo = new \PDO(
                    sprintf("mysql:host=%s; dbname=%s;", $data['host'], $data['db_name']), 
                    "$user",
                    "$pswd",
                
                    [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
                    ]
                );
            } catch(PDOException $e){
                
                if (SHOW_ERROR){
                    __($e->getCode());
                    __($e->getMessage()); die();
                }else{
                    __('error db connect'); die();
                }

            }
        }
        return $this->pdo;
    }

    public function lastInsertId(){
        $this->getConnect();
        return $this->pdo->lastInsertId();
    }

    
}