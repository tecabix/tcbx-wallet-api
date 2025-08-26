<?php
    require '../HttpService.php';
    require '../SingletonUtil.php' ;
    header('Content-Type: application/json; charset=utf-8');
    $util = new SingletonUtil();
    $http = new HttpService($util->ServerProtocolo."://".$util->ServerDominio.":".$util->ServerPuerto);
    switch ($_SERVER['REQUEST_METHOD']) {
        case "POST":
            $token = $_SERVER['HTTP_TOKEN'];
            $body = file_get_contents("php://input");
            echo $http->post("/trabajador/v2", $token, $body);
            die();

    }
?>