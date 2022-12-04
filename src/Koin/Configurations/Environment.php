<?php
namespace Koin\Koin\Configurations;

use Koin\Koin\Constants;

class Environment
{
    private $url;
    function __construct($environment){
            $this->setUrl($environment);
    }
    private function setUrl($url){
        $this->url = $url;
    }
    public function getUrl(){
        return $this->url;
    }
}


?>