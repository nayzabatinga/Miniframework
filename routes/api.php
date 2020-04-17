<?php

namespace routes;
$route = new Routes;

class Routes{

    public function __construct(){
        $this->runRoutes($this->getUrl(),$this->getMethod());
    }

    protected function routes(){
        $routes = [
            'GET'    => ["url" => '/user', "controller" => 'UserController', "action" => 'index'],
            'POST'   => ["url" => '/user', "controller" => 'UserController', "action" => 'store'],
            'PUT'    => ["url" => '/user', "controller" => 'UserController', "action" => 'update'],
            'DELETE' => ["url" => '/user', "controller" => 'UserController', "action" => 'destroy']
        ];
        return $routes;
    }

    protected function runRoutes($url, $method){
        $routes = $this->routes();

        $explodeUrl = explode('/', $url);

        if($url == $routes[$method]["url"]){
           $class = "\\App\\controller\\" . $routes[$method]["controller"];
           $controller = new $class;
           $action = $routes[$method]["action"];
           $controller->$action();

        }else if(count($explodeUrl) > 2 && $routes[$method]["url"] == "/$explodeUrl[1]"){
            $class = "\\App\\controller\\" . $routes[$method]["controller"];
            $controller = new $class;
            $action = $routes[$method]["action"];
            $controller->$action((int)$explodeUrl[2]);

        }else{
            http_response_code(404);
            echo json_encode(["message" =>"Caminho nao encontrado"]);
        }
    }   

    protected function getMethod(){
        return  $_SERVER['REQUEST_METHOD'];
    }

    protected function getUrl(){
        $path =  parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = explode('/api', $path);
        return $path[1];
    }
}