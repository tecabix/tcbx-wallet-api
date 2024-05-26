<?php
    require '../HttpService.php';
    require '../SingletonUtil.php' ;
    header('Content-Type: application/json; charset=utf-8');
    $util = new SingletonUtil();
    $http = new HttpService($util->ServerProtocolo."://".$util->ServerDominio.":".$util->ServerPuerto);
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            $token = $_SERVER['HTTP_TOKEN'];
            echo $http->get("/prestamo/v2", $token);
            die();
        case "POST":
            if(isset($_GET['solicitud'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->post("/prestamo/v2/solicitud", $token, $body);
                die();
            }else{
                $token = $_SERVER['HTTP_TOKEN'];
                $clave = $_GET['clave'];
                echo $http->post("/prestamo/v2?clave=$clave", $token);
                die();
            }
        case "PUT":
            if(isset($_GET['solicitud'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->put("/prestamo/v2/solicitud", $token, $body);
                die();
            }else{
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->put("/prestamo/v2", $token, $body);
                die();
            }
    }
?>