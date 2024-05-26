<?php
class HttpService {
    private  $host = "0.0.0.0";

    function __construct($host){
        $this->host = $host;
    }

    public function exec(string $method, string $url, string $body = "{}" ) {
        $context = stream_context_create([
            "http" => [
                "method"        => $method,
                'header'        => "Content-Type: application/json\r\n",
                "content"       => $body,

                "ignore_errors" => true,
                
            ],
        ]);
        $response = file_get_contents($this->host . $url, false, $context);
        $status_line = $http_response_header[0];
    
        preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
    
        $status = $match[1];
        
        $resultado  = ["status" => $status, "body"=> json_decode($response,true)];
        return json_encode($resultado);
    }

    public function solicitar(string $method, string $url, string $header, string $body = "{}" ) {
        $context = stream_context_create([
            "http" => [
                "method"        => $method,
                'header'        => $header,
                "content"       => $body,
                "ignore_errors" => true,
            ],
        ]);
        $response = file_get_contents($this->host . $url, false, $context);
        $status_line = $http_response_header[0];
    
        preg_match('{HTTP\/\S*\s(\d{3})}', $status_line, $match);
    
        $status = $match[1];
        
        $resultado  = ["status" => $status, "body"=> json_decode($response,true)];
        return json_encode($resultado);
    }

    public function get(string $url, string $token){
        $header = "Content-Type: application/json\r\n";
        $header = $header."token: $token\r\n";
        
        return $this->solicitar("GET",$url, $header);
    }

    public function post(string $url, string $token, string $body = "{}"){
        $header = "Content-Type: application/json\r\n";
        $header = $header."token: $token\r\n";
        return $this->solicitar("POST",$url, $header, $body);
    }

    public function put(string $url, string $token, string $body = "{}"){
        $header = "Content-Type: application/json\r\n";
        $header = $header."token: $token\r\n";
        return $this->solicitar("PUT",$url, $header, $body);
    }

    public function delete(string $url, string $token, string $body = "{}"){
        $header = "Content-Type: application/json\r\n";
        $header = $header."token: $token\r\n";
        return $this->solicitar("DELETE",$url, $header, $body);
    }
}
?>