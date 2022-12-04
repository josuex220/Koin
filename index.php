<?php 
require __DIR__."/vendor/autoload.php";

use Koin\Koin\Koin;
use Koin\Koin\Constants\Endpoints;
use Koin\Koin\Configurations\PaymentConfiguration;
use Koin\Koin\Entities\BNPL\TransparentCheckout\Authorization;

$koin = new Koin("E3CB71BC5DE04965920CE36159EEE9D4", "789C3B78FFE642D1926F88F4E69DC245", Endpoints::Production);

//Configurações
$paymentConfiguration = new PaymentConfiguration;
$paymentConfiguration->setMaxInstallments(12);

$koin->setConfiguration($paymentConfiguration->save());

//Autorização
$auth = new Authorization($koin);

$customerInfo['CPF']            = '06942287539';
$customerInfo['Email']          = 'josue@n49.com.br';
$customerInfo['TotalPrice']     = "999.99";
$customerInfo['UseDate']        = "127001";
$customerInfo['Optin']          = "true";
$customerInfo['SalesChannelId'] = "00";

$auth->setSchema($customerInfo);

print_r($auth->save());

print_r($koin->authorization());
// $transaction = $koin->transaction();
?>