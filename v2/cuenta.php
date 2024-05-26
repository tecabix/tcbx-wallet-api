<?php
    require '../HttpService.php';
    require '../SingletonUtil.php' ;
    header('Content-Type: application/json; charset=utf-8');
    $util = new SingletonUtil();
    $http = new HttpService($util->ServerProtocolo."://".$util->ServerDominio.":".$util->ServerPuerto);
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if(isset($_GET['saldo'])){
                $token = $_SERVER['HTTP_TOKEN'];
                echo $http->get("/cuenta/v2/saldo",$token);
                die();
            }
            
    }
?>