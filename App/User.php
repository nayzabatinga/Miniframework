<?php

namespace App;

use config\Connect;
use PDO;

class User{

    public function create($value){
        $query = "INSERT INTO users (name) VALUES ('$value')";
        Connect::connection()->query($query);
    }
    
    public function all(){
        $query = "SELECT * FROM users";
        $data = Connect::connection()->query($query)->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data); 
    }

    public function destroy($id){
        $query = "DELETE FROM users WHERE id = $id";        
        Connect::connection()->query($query);
    }

    public function update($id, $name){
        $query = "UPDATE users SET name = '$name' WHERE id = $id";        
        Connect::connection()->query($query);
    }

    public function find($id){
        $query = "SELECT * FROM users WHERE id = $id";        
        $data = Connect::connection()->query($query)->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    
}