<?php
namespace Koin\Koin\Entities\BNPL\TransparentCheckout;
use Koin\Koin\Koin;
use Koin\Koin\Configurations\UrlGenerator;
use Koin\Koin\Services\Request;

class Authorization
{
    private $koin       = array();
    const endpoint      = "Transaction/authorization"; 
    private $accessPoint= false;
    private $schema     = array();
    function __construct(Koin $koin){
        $this->koin = $koin;
        $urlGenerator = new UrlGenerator($koin->initpoint);
        $this->accessPoint = $urlGenerator->getUrl(self::endpoint);
    }

    public function setSchema($schema){
        $this->schema = $schema;
        $this->schema['MaxInstallments']    = $this->koin->configuration['maxInstallments'];
    }
    public function save(){
        $request = new Request($this->accessPoint);
        $request->setHeaders(array(
            'Accept: application/json',
            'Content-type: application/json',
            'Authorization: '.$this->koin->class['tokenization'],
            'User-Agent' => $_SERVER['HTTP_USER_AGENT']
        ));
        $request->setMethod("POST");
        $request->setPostfield($this->schema);
        $response = $request->send();

        return $response;
    }


}
?>