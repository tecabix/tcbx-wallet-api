<?php
    require '../HttpService.php';
    require '../SingletonUtil.php' ;
    header('Content-Type: application/json; charset=utf-8');
    $util = new SingletonUtil();
    $http = new HttpService($util->ServerProtocolo."://".$util->ServerDominio.":".$util->ServerPuerto);
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if(isset($_GET['clave']) && isset($_GET['tipo']) && isset($_GET['nombre'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $tipo = $_GET['tipo'];
                $nombre = $_GET['nombre'];
                echo $http->get("/catalogo/v2/clave?tipo=$tipo&nombre=$nombre", $token);
                die();
            }
    }
?>