
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<?php
    require '../HttpService.php';
    require '../SingletonUtil.php' ;
    header('Content-Type: application/json; charset=utf-8');
    $util = new SingletonUtil();
    $http = new HttpService($util->ServerProtocolo."://".$util->ServerDominio.":".$util->ServerPuerto);
    
    switch ($_SERVER['REQUEST_METHOD']) {
        case "POST":

            if(isset($_GET['listado'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->post("/proyecto/v2/listado", $token, $body);
                die();
            }else{
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->post("/proyecto/v2", $token, $body);
                die();
            }

        case "PUT":

            if(isset($_GET['estatus'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->put("/proyecto/v2/estatus", $token, $body);
                die();
            }if(isset($_GET['etapa'])){
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->put("/proyecto/v2/etapa", $token, $body);
                die();
            }else{
                $token = $_SERVER['HTTP_TOKEN'];
                $body = file_get_contents("php://input");
                echo $http->put("/proyecto/v2", $token, $body);
                die();
            }

        case "GET":

            if(isset($_GET['ticket'])){
                $token = trim($_SERVER['HTTP_TOKEN']);

                $ticketp = $_GET['ticket'];
                $response = $http->get("/proyecto/v2?ticket=$ticketp", $token);
                echo $http->get("/proyecto/v2?ticket=$ticketp", $token);
                die();
            }
           
    }
?>