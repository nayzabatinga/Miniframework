<?php

namespace App\controller;

use App\User;

class UserController{

    public function index(){
        return User::all();
    }
    
    public function store(){
        $create = User::create($_REQUEST['name']);
        if($create == NULL){
            echo json_encode(["message" => "Usuario registrado com sucesso!"]);
            http_response_code(201);
        }else{
            echo json_encode(["message" => "Usuario nao registrado"]);
        }
    }
    
    public function update($id){
        $name = explode('=',file_get_contents('php://input'));
        if(User::update($id, $name[1]) == NULL){
            echo json_encode(["message" => "Atualizado com sucesso"]);
        }
    }
    
    public function destroy($id){
        if(!User::find($id)){
            http_response_code(404);
            echo json_encode(["message" => "Usuario nao encontrado"]);
            return;
        }

        User::destroy($id);
        http_response_code(204);
    }
}