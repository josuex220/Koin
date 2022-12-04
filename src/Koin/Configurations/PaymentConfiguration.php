<?php
namespace Koin\Koin\Configurations;

class PaymentConfiguration{
    private $maxInstallments;

    public function setMaxInstallments($installments){
        $this->maxInstallments = $installments;
    }
    public function save(){
      return array(
        'maxInstallments' => $this->maxInstallments
      );
    }
}

?>