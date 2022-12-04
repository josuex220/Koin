<?php 

namespace Koin\Koin;

use Koin\Koin\Entities\BNPL\TokenGenerator\Rest;
use Koin\Koin\Entities\BNPL\TransparentCheckout\Authorization;
use Koin\Koin\Configurations\UrlGenerator;

class Koin{
    public $customerKey;
    public $secretKey;
    public $initpoint; 
    public $configuration;
    public $class;

    function __construct($customerKey, $secretKey, $environment){
        $this->initpoint = $environment;
        $this->secretKey = $secretKey;
        $this->customerKey = $customerKey;
        
        $restEntity = new Rest($this->initpoint, $this->customerKey, $this->secretKey);
        $tokenRest = $restEntity->save();

        $this->class = array(
            'tokenization' => $tokenRest
        );
    }

    public function setConfiguration($configuration){
        $this->configuration  = $configuration;
    }

    public function authorization(){
        
    }

    public function transaction(){

    }
}
?>