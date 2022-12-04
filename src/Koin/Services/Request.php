<?php 
namespace Koin\Koin\Services;

use Exception;
use Koin\Koin\Configurations\UrlGenerator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Request{
    private $headers        = array();
    private $method         = "GET";
    private $postfield      = array();
    private $accessPoint       = false;
    private $clientRequest  = false;

    function __construct($accessPoint = false){
        if($accessPoint){
            $this->accessPoint = $accessPoint;
            $this->client();
        }else{
            throw new Exception("Access Point is required on construct Request Class", 1);
            
        }
    }
    
    public function setHeaders($headers){
        $this->headers = $headers;
    }
    private function getHeaders(){
        return $headers;
    }
    public function setMethod($method = "GET"){
        $this->method = $method;
    }
    private function getMethod(){
        return $method;
    }
    public function setPostfield($postfield = array()){
        $this->postfield = $postfield;
    }
    private function getPostfield(){
        return $postfield;
    }
    private function client(){
        $this->clientRequest = new Client();
    }

    public function send(){
        // echo "<pre>";
        // print_r($this->headers);
        // die;
        
        try {
            $response = $this->clientRequest->request($this->method, $this->accessPoint, [
                'headers' => $this->headers,
                'body'    => json_encode($this->postfield)
            ]);
        } catch (ClientException $th) {
            echo "<pre>";
            print_r($th);
        }
        
        $result = json_decode($response->getBody());
        return $result;
    }
}

?>