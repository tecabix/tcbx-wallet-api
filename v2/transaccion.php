<?php
    require '../HttpService.php';
    require '../SingletonUtil.php' ;
    header('Content-Type: application/json; charset=utf-8');
    $util = new SingletonUtil();
    $http = new HttpService($util->ServerProtocolo."://".$util->ServerDominio.":".$util->ServerPuerto);
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if(isset($_GET['solicitud']) && isset($_GET['clave'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $clave = $_GET['clave'];
                echo $http->get("/transaccion/v2/solicitud?clave=$clave", $token);
                die();
            }else if(isset($_GET['estatus'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $clave = $_GET['clave'];
                echo $http->get("/transaccion/v2/estatus?clave=$clave", $token);
                die();
            }else if(isset($_GET['detalle'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $clave = $_GET['clave'];
                echo $http->get("/transaccion/v2/detalle?clave=$clave", $token);
                die();
            }else{
                $token = $_SERVER['HTTP_TOKEN'];
                $elementos = (isset($_GET['elementos']))?"elementos=".$_GET['elementos']:"";
                $pagina = (isset($_GET['pagina']))?"pagina=".$_GET['pagina']:"";
                if($elementos != ""){
                    $elementos = "?$elementos";
                    $pagina = "&$pagina"; 
                }else if($pagina != ""){
                    $pagina = "?$pagina";
                }
                echo $http->get("/transaccion/v2/$elementos$pagina", $token);
                die();
            }
        case "POST":
            if(isset($_GET['solicitud'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->post("/transaccion/v2/solicitud", $token, $body);
                die();
            }else{
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->post("/transaccion/v2", $token, $body);
                die();
            }
        case "PUT":
            if(isset($_GET['solicitud']) && isset($_GET['clave'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $clave = $_GET['clave'];
                echo $http->put("/transaccion/v2/solicitud?clave=$clave", $token);
                die();
            }
    }
?>