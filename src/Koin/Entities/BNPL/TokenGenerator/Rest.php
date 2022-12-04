<?php
namespace Koin\Koin\Entities\BNPL\TokenGenerator;
use Koin\Koin\Services\Request;
use Koin\Koin\Configurations\UrlGenerator;
class Rest
{
    private $token;
    private $initpoint = false;
    private $customerKey;
    private $secretKey;
    function __construct($initpoint, $customerKey, $secretKey){
        $this->secretKey = $secretKey;
        $this->customerKey = $customerKey;
        $this->initpoint = $initpoint;
    }
    public function setToken($token){
        $this->token = $token;
    }
    public function getToken(){
        return $this->token;
    }
    public function save(){
        $accessPoint = new UrlGenerator($this->initpoint);
       
        $request = new Request($accessPoint->getUrl('access/token/resource'));
        $request->setHeaders(array(
            'accept: application/json',
            'content-type: application/json'
        ));
        $request->setMethod("POST");
        $request->setPostfield([
            "url"           => $accessPoint->getUrl('V1/TransactionService.svc/Request'),
            "consumerKey"   => $this->customerKey,
            "secretKey"     => $this->secretKey
        ]);
        $send = $request->send();
        
        $this->setToken($send->Authorization);

        return $this->getToken();
    }
}
?>