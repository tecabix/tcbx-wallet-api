<?php
    require '../HttpService.php';
    require '../SingletonUtil.php' ;
    header('Content-Type: application/json; charset=utf-8');
    $util = new SingletonUtil();
    $http = new HttpService($util->ServerProtocolo."://".$util->ServerDominio.":".$util->ServerPuerto);
    
    switch ($_SERVER['REQUEST_METHOD']) {
        case "POST":

            if (isset($_GET['comentario']) && isset($_GET['listado'])){
                $token = $_SERVER['HTTP_TOKEN'];

                $elem = $_GET['elementos'];
                $tarea = $_GET['idTarea'];
                $pag = $_GET['pagina'];
                echo $http->post("/tarea/v2/comentario/listado?elementos=$elem&idTarea=$tarea&pagina=$pag", $token);
                die();
            } if(isset($_GET['listado'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->post("/tarea/v2/listado", $token, $body);
                die();
            } if (isset($_GET['comentario'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->post("/tarea/v2/comentario", $token, $body);
                die();
            } else {
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->post("/tarea/v2", $token, $body);
                die();
            }

        case "PUT":

            if(isset($_GET['estatus'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->put("/tarea/v2/estatus", $token, $body);
                die();
            } else{
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->put("/tarea/v2", $token, $body);
                die();
            }

        case "GET":

            if(isset($_GET['ticket'])){
                $token = trim($_SERVER['HTTP_TOKEN']);

                $ticket = $_GET['ticket'];
                $response = $http->get("/tarea/v2?ticket=$ticket", $token);
                echo $http->get("/tarea/v2?ticket=$ticket", $token);
                die();
            }
    }
?>