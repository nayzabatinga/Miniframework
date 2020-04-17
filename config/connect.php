<?php
namespace config;
use PDO;
class Connect{
    
    public function connection (){
        $host = '192.168.0.58';
        $dbname = 'framework';
        $username = 'competidor';
        $password = 'xa02ib';

        try{
            $conn = new PDO("mysql:host=$host;dbname=$dbname", "$username", "$password");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'ERROR: ' . $e->getMessage();
        }
        return $conn;
    }   
}