<?php
    require '../HttpService.php';
    require '../SingletonUtil.php' ;
    header('Content-Type: application/json; charset=utf-8');
    $util = new SingletonUtil();
    $http = new HttpService($util->ServerProtocolo."://".$util->ServerDominio.":".$util->ServerPuerto);
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if(isset($_GET['subasta'])){
                $token = $_SERVER['HTTP_TOKEN'];
                echo $http->get("/bono/v2/subasta", $token);
                die();
            }else if(isset($_GET['obtener'])){
                $token = $_SERVER['HTTP_TOKEN'];
                echo $http->get("/bono/v2", $token);
                die();
            }
    }
?>