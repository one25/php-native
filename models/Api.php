<?php
namespace ApiModel;

//require_once 'Valitron/Validator.php';
require_once './vendor/autoload.php';

use Valitron\Validator as V;

class Api {

public function __construct()
{
   V::langDir(__DIR__.'/validator_lang');
   V::lang('en');
}

public function mailerOrder($row_db, $name, $email, $phone) {
   $title="Order from shop.com ".date('d-m-Y H:i:s');
   $message="<b>Your order:</b><br>";
   if($name && $email && $phone) {
      $message.="Name: <b>".$name."</b><br>";
      $message.="Email: <b>".$email."</b><br>";
      $message.="Phone: <b>".$phone."</b><br>";
      $message.="-------------------------------------<br>";
   }
   $message.="Marka: <b>".$row_db[0]['marka']."</b><br>";
   $message.="Model: <b>".$row_db[0]['model']."</b><br>";
   $message.="Marka: <b>".$row_db[0]['price']."</b>";
   return file_get_contents('http://api.25one.com.ua/api_mail.php?email_to=' . urlencode($_SESSION['login']) . '&title=' . urlencode($title) . '&message=' . urlencode($message));
}

public function mailerCurrency() {
//return file_get_contents('http://www.nbrb.by/API/ExRates/Rates?Periodicity=0');
    $client = new \GuzzleHttp\Client([
       'headers' => [
           //'Authorization' => '9267585bb333341dc049321d4e74398f',
           //'Content-Type' => 'application/json',
        ]
    ]);
    $response = $client->request('GET', 'http://www.nbrb.by/API/ExRates/Rates?Periodicity=0',
         array(
           'request.options' => array(
              'exceptions' => false,
            )
         )
    );
    return $response->getBody()->getContents();
}

public function mailerOrderValidation() {
   $v = new V(array('myemail' => $_SESSION['login']));
   $v->rule('email', 'myemail');
   $result_validate=$v->validate();
   return $result_validate;
}

}

?>
