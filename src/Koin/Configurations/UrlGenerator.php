<?php 
namespace Koin\Koin\Configurations;

    class UrlGenerator{
        private $initPoint;
        public function __construct($initPoint){
            $this->initPoint = $initPoint;
        }
        public function getUrl($endpoint){
            return sprintf($this->initPoint, $endpoint);
        }
    }

?>