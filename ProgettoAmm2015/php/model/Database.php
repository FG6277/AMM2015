<?php

class Database {
    
    private function __construct() {
        
    }
    
    private static $singleton;
 
    public static function getInstance(){
        if(!isset(self::$singleton)){
            self::$singleton = new Database();
        }
        
        return self::$singleton;
    }
    
    public function connectDb(){
        $mysqli = new mysqli();
        /*$mysqli->connect("localhost","gerinaFederica","procione7373", "amm15_gerinaFederica");*/
        $mysqli->connect("localhost","root","davide", "db_scuola2");
        
        if($mysqli->errno != 0){
            return null;
        }else{
            return $mysqli;
        }
    }
}

?>


