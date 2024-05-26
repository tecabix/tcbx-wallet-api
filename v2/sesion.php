<?php
    require '../HttpService.php';
    require '../SingletonUtil.php' ;
    header('Content-Type: application/json; charset=utf-8');
    $util = new SingletonUtil();
    $http = new HttpService($util->ServerProtocolo."://".$util->ServerDominio.":".$util->ServerPuerto);
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if(isset($_GET['validar']) ){
                $token = $_SERVER['HTTP_TOKEN'];
                echo $http->get("/sesion/v2/validar",$token);
                die();
            } else {
                $token = $_SERVER['HTTP_TOKEN'];
                $search = (isset($_GET['buscar']))?"buscar=".$_GET['buscar']:"buscar";
                $by = (isset($_GET['por']))?"&por=".$_GET['por']:"";
                $elements = (isset($_GET['elementos']))?"&elementos=".$_GET['elementos']:"";
                $page = (isset($_GET['pagina']))?"&pagina=".$_GET['pagina']:"";
                echo $http->get("/sesion/v2?".$search.$by.$elements.$page, $token);
                die();
            }
        case "POST":
            $body = file_get_contents("php://input");
            $key = $_SERVER['HTTP_KEY'];
            $header = "Content-Type: application/json\r\n";
            $header = $header."key: $key\r\n"; 
            echo $http->solicitar("POST", "/sesion/v2", $header, $body);
            die();
        case "DELETE":
            $token = $_SERVER['HTTP_TOKEN'];
            echo $http->delete("/sesion/v2", $token);
            die();
    }
?>