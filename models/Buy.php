<?php
namespace BuyModel;

//require_once 'Valitron/Validator.php';
require_once './vendor/autoload.php';

use Valitron\Validator as V;

class Buy {

public $error_validation;

public function __construct()
{
   V::langDir(__DIR__.'/validator_lang');
   V::lang('en');
}

public function mailerBuyValidation($name, $email, $phone) {
   $v = new V(array('name' => $name, 'email' => $email, 'phone' => $phone));
   $v->rule('required', array('name', 'email', 'phone'))->rule('email', 'email');
   $result_validate=$v->validate();
   $this->error_validation=$v->errors();
   return $result_validate;
}

}

?>
